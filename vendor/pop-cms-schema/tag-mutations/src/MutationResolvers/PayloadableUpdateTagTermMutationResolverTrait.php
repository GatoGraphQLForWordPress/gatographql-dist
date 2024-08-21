<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\Exception\TagTermCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait PayloadableUpdateTagTermMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\TagMutations\MutationResolvers\UpdateTagTermMutationResolverTrait {
        \PoPCMSSchema\TagMutations\MutationResolvers\UpdateTagTermMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\TagMutations\MutationResolvers\UpdateTagTermMutationResolverTrait;
    }
    use \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableTagMutationResolverTrait;
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
        $this->validateUpdateErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        $tagTermID = null;
        try {
            /** @var string|int */
            $tagTermID = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (TagTermCRUDMutationException $tagTermCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($tagTermCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $tagTermID)->getID();
        }
        /** @var string|int $tagTermID */
        return $this->createSuccessObjectMutationPayload($tagTermID)->getID();
    }
}