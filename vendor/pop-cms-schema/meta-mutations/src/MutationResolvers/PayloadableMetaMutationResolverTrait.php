<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\MetaMutations\ObjectModels\AccessToMetaKeyIsNotAllowedErrorPayload;
use PoPCMSSchema\MetaMutations\ObjectModels\EntityMetaAlreadyHasSingleEntryErrorPayload;
use PoPCMSSchema\MetaMutations\ObjectModels\EntityMetaEntryAlreadyHasValueErrorPayload;
use PoPCMSSchema\MetaMutations\ObjectModels\EntityMetaKeyDoesNotExistErrorPayload;
use PoPCMSSchema\MetaMutations\ObjectModels\EntityMetaKeyWithValueDoesNotExistErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadableMetaMutationResolverTrait
{
    protected function createMetaMutationErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ?ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1]:
                return new EntityMetaAlreadyHasSingleEntryErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new AccessToMetaKeyIsNotAllowedErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3]:
                return new AccessToMetaKeyIsNotAllowedErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4]:
                return new EntityMetaKeyDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5]:
                return new EntityMetaKeyWithValueDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6]:
                return new EntityMetaEntryAlreadyHasValueErrorPayload($feedbackItemResolution->getMessage());
            default:
                return null;
        }
    }
}
