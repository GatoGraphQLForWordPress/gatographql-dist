<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\Hooks;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\MutationResolvers\MutateEntityMetaMutationResolverTrait;
use PoPCMSSchema\MetaMutations\MutationResolvers\PayloadableMetaMutationResolverTrait;
use PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use stdClass;
/** @internal */
abstract class AbstractMetaMutationResolverHookSet extends AbstractHookSet
{
    use MutateEntityMetaMutationResolverTrait;
    use PayloadableMetaMutationResolverTrait;
    protected abstract function getEntityMetaTypeMutationAPI() : EntityMetaTypeMutationAPIInterface;
    protected function init() : void
    {
        App::addAction($this->getValidateCreateHookName(), \Closure::fromCallable([$this, 'maybeValidateSetMeta']), 10, 2);
        // Comments has create but not update
        $validateUpdateHookName = $this->getValidateUpdateHookName();
        if ($validateUpdateHookName !== null) {
            App::addAction($validateUpdateHookName, \Closure::fromCallable([$this, 'maybeValidateSetMeta']), 10, 2);
        }
        App::addAction($this->getExecuteCreateOrUpdateHookName(), \Closure::fromCallable([$this, 'maybeSetMeta']), 10, 3);
        App::addFilter($this->getErrorPayloadHookName(), \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    protected abstract function getValidateCreateHookName() : string;
    protected abstract function getValidateUpdateHookName() : ?string;
    protected abstract function getExecuteCreateOrUpdateHookName() : string;
    protected abstract function getErrorPayloadHookName() : string;
    public function maybeValidateSetMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        /** @var stdClass */
        $metaEntries = $fieldDataAccessor->getValue(MutationInputProperties::META);
        $keys = \array_keys((array) $metaEntries);
        $this->validateAreMetaKeysAllowed($keys, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function canExecuteMutation(FieldDataAccessorInterface $fieldDataAccessor) : bool
    {
        if (!$fieldDataAccessor->hasValue(MutationInputProperties::META)) {
            return \false;
        }
        /** @var stdClass */
        $meta = $fieldDataAccessor->getValue(MutationInputProperties::META);
        if ((array) $meta === []) {
            return \false;
        }
        return \true;
    }
    /**
     * @param int|string $entityID
     */
    public function maybeSetMeta($entityID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->canExecuteMutation($fieldDataAccessor)) {
            return;
        }
        /** @var stdClass */
        $metaEntries = $fieldDataAccessor->getValue(MutationInputProperties::META);
        $this->getEntityMetaTypeMutationAPI()->setEntityMeta($entityID, (array) $metaEntries);
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        return $this->createMetaMutationErrorPayloadFromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedback) ?? $errorPayload;
    }
}
