<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\TagMetaMutations\Exception\TagTermMetaCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait PayloadableSetTagTermMetaMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolverTrait {
        \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolverTrait;
    }
    use \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableTagMetaMutationResolverTrait;
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
        $tagTermID = null;
        try {
            /** @var string|int */
            $tagTermID = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (TagTermMetaCRUDMutationException $tagTermMetaCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($tagTermMetaCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $tagTermID)->getID();
        }
        /** @var string|int $tagTermID */
        return $this->createSuccessObjectMutationPayload($tagTermID)->getID();
    }
}
