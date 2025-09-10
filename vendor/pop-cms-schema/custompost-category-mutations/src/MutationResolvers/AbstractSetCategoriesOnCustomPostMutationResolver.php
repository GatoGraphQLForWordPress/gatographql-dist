<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs\CustomPostCategoryTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateOrUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\MutateTaxonomyTermMutationResolverTrait;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
abstract class AbstractSetCategoriesOnCustomPostMutationResolver extends AbstractMutationResolver
{
    use CreateOrUpdateCustomPostMutationResolverTrait, MutateTaxonomyTermMutationResolverTrait, \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait {
        CreateOrUpdateCustomPostMutationResolverTrait::getUserNotLoggedInError insteadof MutateTaxonomyTermMutationResolverTrait, \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait;
        CreateOrUpdateCustomPostMutationResolverTrait::validateIsUserLoggedIn insteadof MutateTaxonomyTermMutationResolverTrait, \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait;
        \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait::getTaxonomyTermDoesNotExistError insteadof MutateTaxonomyTermMutationResolverTrait;
        \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait::getTaxonomyTermBySlugDoesNotExistError insteadof MutateTaxonomyTermMutationResolverTrait;
    }
    private ?NameResolverInterface $nameResolver = null;
    private ?UserRoleTypeAPIInterface $userRoleTypeAPI = null;
    private ?CustomPostTypeAPIInterface $customPostTypeAPI = null;
    private ?CustomPostTypeMutationAPIInterface $customPostTypeMutationAPI = null;
    private ?CustomPostCategoryTypeMutationAPIInterface $customPostCategoryTypeMutationAPI = null;
    private ?TaxonomyTermTypeAPIInterface $taxonomyTermTypeAPI = null;
    protected final function getNameResolver() : NameResolverInterface
    {
        if ($this->nameResolver === null) {
            /** @var NameResolverInterface */
            $nameResolver = $this->instanceManager->getInstance(NameResolverInterface::class);
            $this->nameResolver = $nameResolver;
        }
        return $this->nameResolver;
    }
    protected final function getUserRoleTypeAPI() : UserRoleTypeAPIInterface
    {
        if ($this->userRoleTypeAPI === null) {
            /** @var UserRoleTypeAPIInterface */
            $userRoleTypeAPI = $this->instanceManager->getInstance(UserRoleTypeAPIInterface::class);
            $this->userRoleTypeAPI = $userRoleTypeAPI;
        }
        return $this->userRoleTypeAPI;
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
    protected final function getCustomPostTypeMutationAPI() : CustomPostTypeMutationAPIInterface
    {
        if ($this->customPostTypeMutationAPI === null) {
            /** @var CustomPostTypeMutationAPIInterface */
            $customPostTypeMutationAPI = $this->instanceManager->getInstance(CustomPostTypeMutationAPIInterface::class);
            $this->customPostTypeMutationAPI = $customPostTypeMutationAPI;
        }
        return $this->customPostTypeMutationAPI;
    }
    protected final function getCustomPostCategoryTypeMutationAPI() : CustomPostCategoryTypeMutationAPIInterface
    {
        if ($this->customPostCategoryTypeMutationAPI === null) {
            /** @var CustomPostCategoryTypeMutationAPIInterface */
            $customPostCategoryTypeMutationAPI = $this->instanceManager->getInstance(CustomPostCategoryTypeMutationAPIInterface::class);
            $this->customPostCategoryTypeMutationAPI = $customPostCategoryTypeMutationAPI;
        }
        return $this->customPostCategoryTypeMutationAPI;
    }
    protected final function getTaxonomyTermTypeAPI() : TaxonomyTermTypeAPIInterface
    {
        if ($this->taxonomyTermTypeAPI === null) {
            /** @var TaxonomyTermTypeAPIInterface */
            $taxonomyTermTypeAPI = $this->instanceManager->getInstance(TaxonomyTermTypeAPIInterface::class);
            $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
        }
        return $this->taxonomyTermTypeAPI;
    }
    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : mixed
    {
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        $append = $fieldDataAccessor->getValue(MutationInputProperties::APPEND);
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->setCategoriesOnCustomPost($customPostID, $append, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return null;
        }
        return $customPostID;
    }
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsUserLoggedIn($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        $this->validateCustomPostExists($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPost($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCustomPostTypeIsNotEmpty($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        /** @var string */
        $customPostType = $this->getCustomPostTypeAPI()->getCustomPostType($customPostID);
        $this->validateSetCategoriesOnCustomPost($customPostType, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
    protected function getEntityName() : string
    {
        return $this->__('custom post', 'custompost-category-mutations');
    }
}
