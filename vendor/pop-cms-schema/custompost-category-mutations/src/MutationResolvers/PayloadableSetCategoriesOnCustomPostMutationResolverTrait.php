<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCustomPostMutationResolverTrait;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
/** @internal */
trait PayloadableSetCategoriesOnCustomPostMutationResolverTrait
{
    use PayloadableCustomPostMutationResolverTrait {
        PayloadableCustomPostMutationResolverTrait::createErrorPayloadFromObjectTypeFieldResolutionFeedback as upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback;
    }
    use \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolverTrait;
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        return $this->createSetCategoriesOnCustomPostErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback) ?? $this->upstreamCreateErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback);
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
