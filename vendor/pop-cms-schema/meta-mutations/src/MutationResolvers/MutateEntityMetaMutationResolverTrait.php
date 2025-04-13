<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\MutationResolvers;

use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\MetaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
/** @internal */
trait MutateEntityMetaMutationResolverTrait
{
    protected abstract function getMetaTypeAPI() : MetaTypeAPIInterface;
    /**
     * @param string|int $entityID
     */
    protected function validateSingleMetaEntryDoesNotExist($entityID, string $key, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->doesMetaEntryExist($entityID, $key)) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($this->getSingleMetaEntryAlreadyExistsError($entityID, $key), $fieldDataAccessor->getField()));
    }
    /**
     * @param string|int $entityID
     */
    protected abstract function doesMetaEntryExist($entityID, string $key) : bool;
    /**
     * @param string|int $entityID
     */
    protected function getSingleMetaEntryAlreadyExistsError($entityID, string $key) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1, [$entityID, $key]);
    }
    /**
     * @param string|int $entityID
     */
    protected function validateMetaEntryExists($entityID, string $key, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if ($this->doesMetaEntryExist($entityID, $key)) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($this->getMetaEntryDoesNotExistError($entityID, $key), $fieldDataAccessor->getField()));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function validateMetaEntryWithValueExists($entityID, string $key, $value, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if ($this->doesMetaEntryWithValueExist($entityID, $key, $value)) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($this->getMetaEntryWithValueDoesNotExistError($entityID, $key, $value), $fieldDataAccessor->getField()));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected abstract function doesMetaEntryWithValueExist($entityID, string $key, $value) : bool;
    /**
     * @param string|int $entityID
     */
    protected function getMetaEntryDoesNotExistError($entityID, string $key) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4, [$entityID, $key]);
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function getMetaEntryWithValueDoesNotExistError($entityID, string $key, $value) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5, [$entityID, $key, $value]);
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function validateMetaEntryDoesNotHaveValue($entityID, string $key, $value, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->doesMetaEntryHaveValue($entityID, $key, $value)) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($this->getEntityMetaEntryAlreadyHasValueError($entityID, $key, $value), $fieldDataAccessor->getField()));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected abstract function doesMetaEntryHaveValue($entityID, string $key, $value) : bool;
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function getEntityMetaEntryAlreadyHasValueError($entityID, string $key, $value) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6, [$entityID, $key, $value]);
    }
    /**
     * @param string[] $metaKeys
     */
    protected function validateAreMetaKeysAllowed(array $metaKeys, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $taxonomyMetaTypeAPI = $this->getMetaTypeAPI();
        $nonAllowedMetaKeys = \array_filter($metaKeys, function (string $metaKey) use($taxonomyMetaTypeAPI) {
            return !$taxonomyMetaTypeAPI->validateIsMetaKeyAllowed($metaKey);
        });
        if ($nonAllowedMetaKeys === []) {
            return;
        }
        if (\count($nonAllowedMetaKeys) === 1) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2, [$metaKeys[0]]), $fieldDataAccessor->getField()));
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3, [\implode($this->__('\', \'', 'taxonomymeta-mutations'), $metaKeys)]), $fieldDataAccessor->getField()));
    }
}
