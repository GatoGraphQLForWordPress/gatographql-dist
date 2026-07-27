<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait PayloadableDeleteCustomPostMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteCustomPostMutationResolverTrait {
        \PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteCustomPostMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteCustomPostMutationResolverTrait;
    }
    use \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCustomPostMutationResolverTrait;
    /**
     * Validate the app-level errors when executing the mutation,
     * return them in the Payload.
     *
     * @throws AbstractException In case of error
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : mixed
    {
        $separateObjectTypeFieldResolutionFeedbackStore = new ObjectTypeFieldResolutionFeedbackStore();
        $this->validateDeleteErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map($this->createErrorPayloadFromObjectTypeFieldResolutionFeedback(...), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        /** @var string|int */
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::ID);
        /**
         * Deleting the custom post either succeeds, or throws an exception.
         * Hence there are no errors to collect after executing the mutation.
         */
        try {
            $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (CustomPostCRUDMutationException $customPostCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($customPostCRUDMutationException)])->getID();
        }
        return $this->createSuccessObjectMutationPayload($customPostID)->getID();
    }
}
