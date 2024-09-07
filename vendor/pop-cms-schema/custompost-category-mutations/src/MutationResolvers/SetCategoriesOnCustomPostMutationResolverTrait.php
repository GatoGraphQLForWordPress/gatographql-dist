<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\ObjectModels\CategoryTermDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\TaxonomyMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider as TaxonomyMutationErrorFeedbackItemProvider;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\SetTaxonomyTermsOnCustomPostMutationResolverTrait;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyIsNotValidErrorPayload;
use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use stdClass;
/** @internal */
trait SetCategoriesOnCustomPostMutationResolverTrait
{
    use SetTaxonomyTermsOnCustomPostMutationResolverTrait;
    /**
     * @param array<string|int> $taxonomyTermIDs
     */
    protected function getTaxonomyIsNotRegisteredInCustomPostTypeFeedbackItemResolution(string $customPostType, string $taxonomyName, array $taxonomyTermIDs) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4, [$taxonomyName, \implode('\', \'', $taxonomyTermIDs), $customPostType]);
    }
    protected function validateSetCategoriesOnCustomPost(string $customPostType, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        /** @var stdClass|null */
        $categoriesBy = $fieldDataAccessor->getValue(MutationInputProperties::CATEGORIES_BY);
        if ($categoriesBy === null || (array) $categoriesBy === []) {
            return;
        }
        // If `null` there was an error (already added to FeedbackStore)
        $categoryTaxonomyToTaxonomyTerms = $this->getCategoryTaxonomyToTaxonomyTerms($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($categoryTaxonomyToTaxonomyTerms === null) {
            return;
        }
        foreach ($categoryTaxonomyToTaxonomyTerms as $taxonomyName => $categoryIDs) {
            $this->validateCanLoggedInUserAssignTermsToTaxonomy($taxonomyName, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
            $this->validateTaxonomyIsRegisteredForCustomPostType($customPostType, $taxonomyName, $categoryIDs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    /**
     * @param string|int $customPostID
     */
    protected function setCategoriesOnCustomPost($customPostID, bool $append, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        /** @var array<string,array<string|int>> */
        $categoryTaxonomyToTaxonomyTerms = $this->getCategoryTaxonomyToTaxonomyTerms($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        foreach ($categoryTaxonomyToTaxonomyTerms as $taxonomyName => $categoryIDs) {
            $this->getCustomPostCategoryTypeMutationAPI()->setCategoriesByID($taxonomyName, $customPostID, $categoryIDs, $append);
        }
    }
    /**
     * Retrieve the taxonomy from the queried object's CPT,
     * which works as long as it has only 1 category taxonomy registered.
     *
     * @return array<string,array<string|int>>|null
     */
    protected function getCategoryTaxonomyToTaxonomyTerms(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : ?array
    {
        $categoriesBy = $fieldDataAccessor->getValue(MutationInputProperties::CATEGORIES_BY);
        if (isset($categoriesBy->{MutationInputProperties::IDS})) {
            $categoryIDs = $categoriesBy->{MutationInputProperties::IDS};
            return $this->getTaxonomyToTaxonomyTermsByID(\true, $categoryIDs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
        if (isset($categoriesBy->{MutationInputProperties::SLUGS})) {
            $categorySlugs = $categoriesBy->{MutationInputProperties::SLUGS};
            return $this->getTaxonomyToTaxonomyTermsBySlug(\true, $categorySlugs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
        return null;
    }
    public function createSetCategoriesOnCustomPostErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ?ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1]:
                return new UserIsNotLoggedInErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4]:
                return new TaxonomyIsNotValidErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [TaxonomyMutationErrorFeedbackItemProvider::class, TaxonomyMutationErrorFeedbackItemProvider::E10]:
                return new LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload($feedbackItemResolution->getMessage());
            case [TaxonomyMutationErrorFeedbackItemProvider::class, TaxonomyMutationErrorFeedbackItemProvider::E11]:
                return new TaxonomyIsNotValidErrorPayload($feedbackItemResolution->getMessage());
            case [TaxonomyMutationErrorFeedbackItemProvider::class, TaxonomyMutationErrorFeedbackItemProvider::E12]:
                return new TaxonomyIsNotValidErrorPayload($feedbackItemResolution->getMessage());
            default:
                return null;
        }
    }
    /**
     * @param string|int $taxonomyTermID
     */
    protected function getTaxonomyTermDoesNotExistError(?string $taxonomyName, $taxonomyTermID) : FeedbackItemResolution
    {
        if ($taxonomyName !== null && $taxonomyName !== '') {
            return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7, [$taxonomyName, $taxonomyTermID]);
        }
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6, [$taxonomyTermID]);
    }
    /**
     * @param string|int $taxonomyTermSlug
     */
    protected function getTaxonomyTermBySlugDoesNotExistError(?string $taxonomyName, $taxonomyTermSlug) : FeedbackItemResolution
    {
        if ($taxonomyName !== null && $taxonomyName !== '') {
            return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9, [$taxonomyName, $taxonomyTermSlug]);
        }
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8, [$taxonomyTermSlug]);
    }
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
}
