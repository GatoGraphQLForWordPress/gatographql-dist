<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\Hooks;

use PoPCMSSchema\CustomPostMediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMediaMutations\ObjectModels\MediaItemDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostMediaMutations\TypeAPIs\CustomPostMediaTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMutations\Constants\HookNames;
use PoPCMSSchema\Media\Constants\InputProperties;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use stdClass;
/** @internal */
class MutationResolverHookSet extends AbstractHookSet
{
    use SetFeaturedImageOnCustomPostMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeAPIs\CustomPostMediaTypeMutationAPIInterface|null
     */
    private $customPostMediaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface|null
     */
    private $mediaTypeAPI;
    public final function setCustomPostMediaTypeMutationAPI(CustomPostMediaTypeMutationAPIInterface $customPostMediaTypeMutationAPI) : void
    {
        $this->customPostMediaTypeMutationAPI = $customPostMediaTypeMutationAPI;
    }
    protected final function getCustomPostMediaTypeMutationAPI() : CustomPostMediaTypeMutationAPIInterface
    {
        if ($this->customPostMediaTypeMutationAPI === null) {
            /** @var CustomPostMediaTypeMutationAPIInterface */
            $customPostMediaTypeMutationAPI = $this->instanceManager->getInstance(CustomPostMediaTypeMutationAPIInterface::class);
            $this->customPostMediaTypeMutationAPI = $customPostMediaTypeMutationAPI;
        }
        return $this->customPostMediaTypeMutationAPI;
    }
    public final function setMediaTypeAPI(MediaTypeAPIInterface $mediaTypeAPI) : void
    {
        $this->mediaTypeAPI = $mediaTypeAPI;
    }
    protected final function getMediaTypeAPI() : MediaTypeAPIInterface
    {
        if ($this->mediaTypeAPI === null) {
            /** @var MediaTypeAPIInterface */
            $mediaTypeAPI = $this->instanceManager->getInstance(MediaTypeAPIInterface::class);
            $this->mediaTypeAPI = $mediaTypeAPI;
        }
        return $this->mediaTypeAPI;
    }
    protected function init() : void
    {
        App::addAction(HookNames::VALIDATE_CREATE_OR_UPDATE, \Closure::fromCallable([$this, 'maybeValidateFeaturedImage']), 10, 2);
        App::addAction(HookNames::EXECUTE_CREATE_OR_UPDATE, \Closure::fromCallable([$this, 'maybeSetOrRemoveFeaturedImage']), 10, 2);
        App::addFilter(HookNames::ERROR_PAYLOAD, \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    public function maybeValidateFeaturedImage(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        /** @var stdClass|null */
        $featuredImageBy = $fieldDataAccessor->getValue(MutationInputProperties::FEATUREDIMAGE_BY);
        if ($featuredImageBy === null) {
            return;
        }
        if (isset($featuredImageBy->{InputProperties::ID})) {
            /** @var string|int */
            $featuredImageID = $featuredImageBy->{InputProperties::ID};
            $this->validateMediaItemByIDExists($featuredImageID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        } elseif (isset($featuredImageBy->{InputProperties::SLUG})) {
            /** @var string */
            $featuredImageSlug = $featuredImageBy->{InputProperties::SLUG};
            $this->validateMediaItemBySlugExists($featuredImageSlug, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    /**
     * Entry "featuredImageBy" must either have the input with the
     * ID or slug, or it must have `null` to execute the mutation.
     * (i.e. remove the featured image).
     * Only if not provided, then nothing to do.
     */
    protected function canExecuteMutation(FieldDataAccessorInterface $fieldDataAccessor) : bool
    {
        return $fieldDataAccessor->hasValue(MutationInputProperties::FEATUREDIMAGE_BY);
    }
    /**
     * If entry "featuredImageID" has an ID, set it. If it is null, remove it
     * @param int|string $customPostID
     */
    public function maybeSetOrRemoveFeaturedImage($customPostID, FieldDataAccessorInterface $fieldDataAccessor) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        /**
         * @var stdClass|null
         */
        $featuredImageBy = $fieldDataAccessor->getValue(MutationInputProperties::FEATUREDIMAGE_BY);
        if ($featuredImageBy === null) {
            /**
             * If is `null` or {} => remove the featured image
             */
            $this->getCustomPostMediaTypeMutationAPI()->removeFeaturedImage($customPostID);
            return;
        }
        $featuredImageID = null;
        if (isset($featuredImageBy->{InputProperties::ID})) {
            /** @var string|int */
            $featuredImageID = $featuredImageBy->{InputProperties::ID};
        } elseif (isset($featuredImageBy->{InputProperties::SLUG})) {
            $mediaTypeAPI = $this->getMediaTypeAPI();
            /** @var string */
            $featuredImageSlug = $featuredImageBy->{InputProperties::SLUG};
            /** @var object */
            $featuredImage = $mediaTypeAPI->getMediaItemBySlug($featuredImageSlug);
            $featuredImageID = $mediaTypeAPI->getMediaItemID($featuredImage);
        } elseif (\property_exists($featuredImageBy, InputProperties::ID) || \property_exists($featuredImageBy, InputProperties::SLUG)) {
            /**
             * Passing `updatePost(input: { featuredImageBy: {id: null} })`
             * or `updatePost(input: { featuredImageBy: {slug: null} })`
             * is supported, in which case the featured image is removed
             */
            $this->getCustomPostMediaTypeMutationAPI()->removeFeaturedImage($customPostID);
            return;
        }
        if ($featuredImageID === null) {
            return;
        }
        /** @var string|int $featuredImageID */
        $this->getCustomPostMediaTypeMutationAPI()->setFeaturedImage($customPostID, $featuredImageID);
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new MediaItemDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5]:
                return new MediaItemDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            default:
                return $errorPayload;
        }
    }
}
