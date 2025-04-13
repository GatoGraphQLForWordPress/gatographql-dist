<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\CategoryMetaMutations\Exception\CategoryTermMetaCRUDMutationException;
use PoPSchema\SchemaCommons\MutationResolvers\PayloadableMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait PayloadableAddCategoryTermMetaMutationResolverTrait
{
    use PayloadableMutationResolverTrait, \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolverTrait {
        \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolverTrait::executeMutation as upstreamExecuteMutation;
        PayloadableMutationResolverTrait::validate insteadof \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolverTrait;
    }
    use \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableCategoryMetaMutationResolverTrait;
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
        $this->validateAddMetaErrors($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()))->getID();
        }
        $categoryTermID = null;
        try {
            /** @var string|int */
            $categoryTermID = $this->upstreamExecuteMutation($fieldDataAccessor, $separateObjectTypeFieldResolutionFeedbackStore);
        } catch (CategoryTermMetaCRUDMutationException $categoryTermMetaCRUDMutationException) {
            return $this->createFailureObjectMutationPayload([$this->createGenericErrorPayloadFromPayloadClientException($categoryTermMetaCRUDMutationException)])->getID();
        }
        if ($separateObjectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return $this->createFailureObjectMutationPayload(\array_map(\Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), $separateObjectTypeFieldResolutionFeedbackStore->getErrors()), $categoryTermID)->getID();
        }
        /** @var string|int $categoryTermID */
        return $this->createSuccessObjectMutationPayload($categoryTermID)->getID();
    }
}
