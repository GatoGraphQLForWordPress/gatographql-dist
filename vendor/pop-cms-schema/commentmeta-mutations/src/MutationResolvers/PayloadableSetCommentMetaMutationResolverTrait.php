<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\CommentMetaMutations\Exception\CommentMetaCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait PayloadableSetCommentMetaMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolverTrait {
        \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolverTrait;
    }
    use \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableCommentMetaMutationResolverTrait;
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
        $this->validateSetMetaErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        $commentID = null;
        try {
            /** @var string|int */
            $commentID = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (CommentMetaCRUDMutationException $commentMetaCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($commentMetaCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $commentID)->getID();
        }
        /** @var string|int $commentID */
        return $this->createSuccessObjectMutationPayload($commentID)->getID();
    }
}
