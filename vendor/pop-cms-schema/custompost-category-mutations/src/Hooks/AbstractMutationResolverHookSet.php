<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\Hooks;

use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs\CustomPostCategoryTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMutations\Constants\CustomPostCRUDHookNames;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
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
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs\CustomPostCategoryTypeMutationAPIInterface|null
     */
    private $customPostCategoryTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
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
    protected function init() : void
    {
        App::addAction($this->getValidateCreateHookName(), \Closure::fromCallable([$this, 'maybeValidateCategories']), 10, 3);
        App::addAction($this->getValidateUpdateHookName(), \Closure::fromCallable([$this, 'maybeValidateCategories']), 10, 3);
        App::addAction($this->getExecuteCreateOrUpdateHookName(), \Closure::fromCallable([$this, 'maybeSetCategories']), 10, 3);
        App::addFilter($this->getErrorPayloadHookName(), \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    protected abstract function getValidateCreateHookName() : string;
    protected abstract function getValidateUpdateHookName() : string;
    protected abstract function getExecuteCreateOrUpdateHookName() : string;
    protected function getErrorPayloadHookName() : string
    {
        return CustomPostCRUDHookNames::ERROR_PAYLOAD;
    }
    public function maybeValidateCategories(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore, string $customPostType) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsUserLoggedIn($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateSetCategoriesOnCustomPost($customPostType, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
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
        return \true;
    }
    /**
     * @param int|string $customPostID
     */
    public function maybeSetCategories($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        $this->setCategoriesOnCustomPost($customPostID, \false, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        return $this->createSetCategoriesOnCustomPostErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback) ?? $errorPayload;
    }
}
