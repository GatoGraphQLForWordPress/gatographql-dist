<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
trait PayloadableCreateCustomPostMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait {
        \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;
    }
    use \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCustomPostMutationResolverTrait;
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
        $this->validateCreateErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        $customPostID = null;
        try {
            /** @var string|int */
            $customPostID = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (CustomPostCRUDMutationException $customPostCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($customPostCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $customPostID)->getID();
        }
        /** @var string|int $customPostID */
        return $this->createSuccessObjectMutationPayload($customPostID)->getID();
    }
}
