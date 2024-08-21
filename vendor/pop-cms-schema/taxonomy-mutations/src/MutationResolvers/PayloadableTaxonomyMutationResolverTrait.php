<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\Constants\HookNames;
use PoPCMSSchema\TaxonomyMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyDoesNotExistErrorPayload;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyTermDoesNotExistErrorPayload;
use PoPCMSSchema\TaxonomyMutations\ObjectModels\LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayload;
use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoPSchema\SchemaCommons\ObjectModels\GenericErrorPayload;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadableTaxonomyMutationResolverTrait
{
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [$this->getUserNotLoggedInErrorFeedbackItemProviderClass(), $this->getUserNotLoggedInErrorFeedbackItemProviderCode()]:
                return new UserIsNotLoggedInErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5]:
                return new TaxonomyDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6]:
                return new TaxonomyTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new TaxonomyTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8]:
                return new TaxonomyTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9]:
                return new TaxonomyTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            default:
                return App::applyFilters(HookNames::ERROR_PAYLOAD, new GenericErrorPayload($feedbackItemResolution->getMessage(), $feedbackItemResolution->getNamespacedCode()), $objectTypeFieldResolutionFeedback);
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
