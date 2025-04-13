<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\Constants\CustomPostCRUDHookNames;
use PoPCMSSchema\CustomPostMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostDoesNotHaveExpectedTypeErrorPayload;
use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload;
use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoPermissionToEditCustomPostErrorPayload;
use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayload;
use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoPSchema\SchemaCommons\ObjectModels\GenericErrorPayload;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadableCustomPostMutationResolverTrait
{
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [$this->getUserNotLoggedInErrorFeedbackItemProviderClass(), $this->getUserNotLoggedInErrorFeedbackItemProviderCode()]:
                return new UserIsNotLoggedInErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3]:
                return new LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8]:
                return new LoggedInUserHasNoPermissionToEditCustomPostErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9]:
                return new LoggedInUserHasNoPermissionToEditCustomPostErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new CustomPostDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5]:
                return new CustomPostDoesNotHaveExpectedTypeErrorPayload($feedbackItemResolution->getMessage());
            default:
                return App::applyFilters(CustomPostCRUDHookNames::ERROR_PAYLOAD, new GenericErrorPayload($feedbackItemResolution->getMessage(), $feedbackItemResolution->getNamespacedCode()), $objectTypeFieldResolutionFeedback);
        }
    }
    protected function getUserNotLoggedInErrorFeedbackItemProviderClass() : string
    {
        return MutationErrorFeedbackItemProvider::class;
    }
    protected function getUserNotLoggedInErrorFeedbackItemProviderCode() : string
    {
        return MutationErrorFeedbackItemProvider::E1;
    }
}
