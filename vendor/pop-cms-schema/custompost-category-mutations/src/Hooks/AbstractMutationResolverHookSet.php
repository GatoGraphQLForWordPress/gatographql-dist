<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\Hooks;

use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostCategoryMutations\ObjectModels\CategoryDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs\CustomPostCategoryTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMutations\Constants\HookNames;
use PoPCMSSchema\CustomPostMutations\Constants\MutationInputProperties as CustomPostMutationsMutationInputProperties;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\TaxonomyMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider as TaxonomyMutationErrorFeedbackItemProvider;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use stdClass;
/** @internal */
abstract class AbstractMutationResolverHookSet extends AbstractHookSet
{
    use SetCategoriesOnCustomPostMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    public final function setCustomPostTypeAPI(CustomPostTypeAPIInterface $customPostTypeAPI) : void
    {
        $this->customPostTypeAPI = $customPostTypeAPI;
    }
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
    }
    protected function init() : void
    {
        App::addAction(HookNames::VALIDATE_CREATE_OR_UPDATE, \Closure::fromCallable([$this, 'maybeValidateCategories']), 10, 2);
        App::addAction(HookNames::EXECUTE_CREATE_OR_UPDATE, \Closure::fromCallable([$this, 'maybeSetCategories']), 10, 2);
        App::addFilter(HookNames::ERROR_PAYLOAD, \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    public function maybeValidateCategories(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        $categoriesBy = $fieldDataAccessor->getValue(MutationInputProperties::CATEGORIES_BY);
        if (isset($categoriesBy->{MutationInputProperties::IDS})) {
            $customPostCategoryIDs = $categoriesBy->{MutationInputProperties::IDS};
            $this->validateCategoriesByIDExist($customPostCategoryIDs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        } elseif (isset($categoriesBy->{MutationInputProperties::SLUGS})) {
            $customPostCategorySlugs = $categoriesBy->{MutationInputProperties::SLUGS};
            $this->validateCategoriesBySlugExist($customPostCategorySlugs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    protected function canExecuteMutation(FieldDataAccessorInterface $fieldDataAccessor) : bool
    {
        if (!$fieldDataAccessor->hasValue(MutationInputProperties::CATEGORIES_BY)) {
            return \false;
        }
        /** @var stdClass */
        $categoriesBy = $fieldDataAccessor->getValue(MutationInputProperties::CATEGORIES_BY);
        if ((array) $categoriesBy === []) {
            return \false;
        }
        // Only for that specific CPT
        $customPostID = $fieldDataAccessor->getValue(CustomPostMutationsMutationInputProperties::ID);
        if ($customPostID !== null && $this->getCustomPostTypeAPI()->getCustomPostType($customPostID) !== $this->getCustomPostType()) {
            return \false;
        }
        return \true;
    }
    /**
     * @param int|string $customPostID
     */
    public function maybeSetCategories($customPostID, FieldDataAccessorInterface $fieldDataAccessor) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        /** @var stdClass */
        $categoriesBy = $fieldDataAccessor->getValue(MutationInputProperties::CATEGORIES_BY);
        if (isset($categoriesBy->{MutationInputProperties::IDS})) {
            /** @var array<string|int> */
            $customPostCategoryIDs = $categoriesBy->{MutationInputProperties::IDS};
            $this->getCustomPostCategoryTypeMutationAPI()->setCategoriesByID($customPostID, $customPostCategoryIDs, \false);
        } elseif (isset($categoriesBy->{MutationInputProperties::SLUGS})) {
            /** @var string[] */
            $customPostCategorySlugs = $categoriesBy->{MutationInputProperties::SLUGS};
            $this->getCustomPostCategoryTypeMutationAPI()->setCategoriesBySlug($customPostID, $customPostCategorySlugs, \false);
        }
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new CategoryDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [TaxonomyMutationErrorFeedbackItemProvider::class, TaxonomyMutationErrorFeedbackItemProvider::E10]:
                return new LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload($feedbackItemResolution->getMessage());
            default:
                return $errorPayload;
        }
    }
    protected abstract function getCustomPostType() : string;
    protected abstract function getCustomPostCategoryTypeMutationAPI() : CustomPostCategoryTypeMutationAPIInterface;
}
