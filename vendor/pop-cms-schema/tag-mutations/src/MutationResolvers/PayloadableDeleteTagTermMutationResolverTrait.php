<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\Exception\TagTermCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
/** @internal */
trait PayloadableDeleteTagTermMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait {
        \PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait;
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
        $this->validateDeleteErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        /** @var string|int */
        $tagTermID = $fieldDataAccessor->getValue(MutationInputProperties::ID);
        try {
            /** @var bool */
            $operationSuccessful = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (TagTermCRUDMutationException $tagTermCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($tagTermCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $tagTermID)->getID();
        }
        return $this->createSuccessObjectMutationPayload($tagTermID)->getID();
    }
}
