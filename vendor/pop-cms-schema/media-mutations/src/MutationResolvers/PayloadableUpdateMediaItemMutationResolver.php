<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\MediaMutations\Constants\HookNames;
use PoPCMSSchema\MediaMutations\Exception\MediaItemCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoPSchema\SchemaCommons\ObjectModels\GenericErrorPayload;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
class PayloadableUpdateMediaItemMutationResolver extends \PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver
{
    use PayloadableMutationResolverTrait;
    /**
     * Validate the app-level errors when executing the mutation,
     * return them in the Payload.
     *
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $separateObjectTypeFieldResolutionFeedbackStore = new ObjectTypeFieldResolutionFeedbackStore();
        parent::validate($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        $mediaItemID = null;
        try {
            /** @var string|int */
            $mediaItemID = parent::executeMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (MediaItemCRUDMutationException $mediaItemCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($mediaItemCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $mediaItemID)->getID();
        }
        /** @var string|int $mediaItemID */
        return $this->createSuccessObjectMutationPayload($mediaItemID)->getID();
    }
    protected function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        // Allow components to inject their own validations
        return App::applyFilters(HookNames::ERROR_PAYLOAD, $this->createOrUpdateMediaItemErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback) ?? new GenericErrorPayload($feedbackItemResolution->getMessage(), $feedbackItemResolution->getNamespacedCode()), $objectTypeFieldResolutionFeedback);
    }
}