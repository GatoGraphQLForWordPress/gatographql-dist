<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\Hooks;

use PoPCMSSchema\CustomPostMutations\Constants\CustomPostCRUDHookNames;
use PoPCMSSchema\CustomPostTagMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface;
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
    use SetTagsOnCustomPostMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface|null
     */
    private $customPostTagTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
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
    public final function setCustomPostTagTypeMutationAPI(CustomPostTagTypeMutationAPIInterface $customPostTagTypeMutationAPI) : void
    {
        $this->customPostTagTypeMutationAPI = $customPostTagTypeMutationAPI;
    }
    protected final function getCustomPostTagTypeMutationAPI() : CustomPostTagTypeMutationAPIInterface
    {
        if ($this->customPostTagTypeMutationAPI === null) {
            /** @var CustomPostTagTypeMutationAPIInterface */
            $customPostTagTypeMutationAPI = $this->instanceManager->getInstance(CustomPostTagTypeMutationAPIInterface::class);
            $this->customPostTagTypeMutationAPI = $customPostTagTypeMutationAPI;
        }
        return $this->customPostTagTypeMutationAPI;
    }
    public final function setTaxonomyTermTypeAPI(TaxonomyTermTypeAPIInterface $taxonomyTermTypeAPI) : void
    {
        $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
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
        App::addAction($this->getValidateCreateHookName(), \Closure::fromCallable([$this, 'maybeValidateTags']), 10, 3);
        App::addAction($this->getValidateUpdateHookName(), \Closure::fromCallable([$this, 'maybeValidateTags']), 10, 3);
        App::addAction($this->getExecuteCreateOrUpdateHookName(), \Closure::fromCallable([$this, 'maybeSetTags']), 10, 3);
        App::addFilter($this->getErrorPayloadHookName(), \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    protected abstract function getValidateCreateHookName() : string;
    protected abstract function getValidateUpdateHookName() : string;
    protected abstract function getExecuteCreateOrUpdateHookName() : string;
    protected function getErrorPayloadHookName() : string
    {
        return CustomPostCRUDHookNames::ERROR_PAYLOAD;
    }
    public function maybeValidateTags(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore, string $customPostType) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsUserLoggedIn($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateSetTagsOnCustomPost($customPostType, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function canExecuteMutation(FieldDataAccessorInterface $fieldDataAccessor) : bool
    {
        if (!$fieldDataAccessor->hasValue(MutationInputProperties::TAGS_BY)) {
            return \false;
        }
        /** @var stdClass */
        $tagsBy = $fieldDataAccessor->getValue(MutationInputProperties::TAGS_BY);
        if ((array) $tagsBy === []) {
            return \false;
        }
        return \true;
    }
    /**
     * @param int|string $customPostID
     */
    public function maybeSetTags($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        $this->setTagsOnCustomPost($customPostID, \false, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        return $this->createSetTagsOnCustomPostErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback) ?? $errorPayload;
    }
}
