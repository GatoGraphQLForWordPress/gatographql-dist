<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\PageMutations\Constants\PageCRUDHookNames;
use PoPCMSSchema\PageMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\PageMutations\ObjectModels\LoggedInUserHasNoEditingPageCapabilityErrorPayload;
use PoPCMSSchema\PageMutations\ObjectModels\LoggedInUserHasNoPublishingPageCapabilityErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadablePageMutationResolverTrait
{
    use PayloadableUpdateCustomPostMutationResolverTrait {
        createErrorPayloadFromObjectTypeFieldResolutionFeedback as upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback;
    }
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new LoggedInUserHasNoEditingPageCapabilityErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3]:
                return new LoggedInUserHasNoPublishingPageCapabilityErrorPayload($feedbackItemResolution->getMessage());
            default:
                return App::applyFilters(PageCRUDHookNames::ERROR_PAYLOAD, $this->upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback), $objectTypeFieldResolutionFeedback);
        }
    }
}
