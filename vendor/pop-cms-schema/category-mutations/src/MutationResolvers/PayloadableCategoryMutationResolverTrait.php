<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\Constants\CategoryCRUDHookNames;
use PoPCMSSchema\CategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CategoryMutations\ObjectModels\CategoryTermDoesNotExistErrorPayload;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\PayloadableTaxonomyMutationResolverTrait;
use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadableCategoryMutationResolverTrait
{
    use PayloadableTaxonomyMutationResolverTrait {
        PayloadableTaxonomyMutationResolverTrait::createErrorPayloadFromObjectTypeFieldResolutionFeedback as upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback;
    }
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [$this->getUserNotLoggedInErrorFeedbackItemProviderClass(), $this->getUserNotLoggedInErrorFeedbackItemProviderCode()]:
                return new UserIsNotLoggedInErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9]:
                return new CategoryTermDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            default:
                return App::applyFilters(CategoryCRUDHookNames::ERROR_PAYLOAD, $this->upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback), $objectTypeFieldResolutionFeedback);
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
