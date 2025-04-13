<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\MutationResolvers\AbstractMutateEntityMetaMutationResolver;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoPCMSSchema\TaxonomyMetaMutations\Constants\TaxonomyMetaCRUDHookNames;
use PoPCMSSchema\TaxonomyMetaMutations\Exception\TaxonomyTermMetaCRUDMutationException;
use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface;
use PoPCMSSchema\TaxonomyMeta\TypeAPIs\TaxonomyMetaTypeAPIInterface;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\MutateTaxonomyTermMutationResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
/** @internal */
abstract class AbstractMutateTaxonomyTermMetaMutationResolver extends AbstractMutateEntityMetaMutationResolver implements \PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers\TaxonomyTermMetaMutationResolverInterface
{
    use MutateTaxonomyTermMutationResolverTrait;
    use \PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers\MutateTaxonomyTermMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\TaxonomyMeta\TypeAPIs\TaxonomyMetaTypeAPIInterface|null
     */
    private $taxonomyMetaTypeAPI;
    /**
     * @var \PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface|null
     */
    private $taxonomyMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    protected final function getTaxonomyMetaTypeAPI() : TaxonomyMetaTypeAPIInterface
    {
        if ($this->taxonomyMetaTypeAPI === null) {
            /** @var TaxonomyMetaTypeAPIInterface */
            $taxonomyMetaTypeAPI = $this->instanceManager->getInstance(TaxonomyMetaTypeAPIInterface::class);
            $this->taxonomyMetaTypeAPI = $taxonomyMetaTypeAPI;
        }
        return $this->taxonomyMetaTypeAPI;
    }
    protected final function getTaxonomyMetaTypeMutationAPI() : TaxonomyMetaTypeMutationAPIInterface
    {
        if ($this->taxonomyMetaTypeMutationAPI === null) {
            /** @var TaxonomyMetaTypeMutationAPIInterface */
            $taxonomyMetaTypeMutationAPI = $this->instanceManager->getInstance(TaxonomyMetaTypeMutationAPIInterface::class);
            $this->taxonomyMetaTypeMutationAPI = $taxonomyMetaTypeMutationAPI;
        }
        return $this->taxonomyMetaTypeMutationAPI;
    }
    protected final function getTaxonomyTermTypeAPI() : TaxonomyTermTypeAPIInterface
    {
        if ($this->taxonomyTermTypeAPI === null) {
            /** @var TaxonomyTermTypeAPIInterface */
            $taxonomyTermTypeAPI = $this->instanceManager->getInstance(TaxonomyTermTypeAPIInterface::class);
            $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
        }
        return $this->taxonomyTermTypeAPI;
    }
    /**
     * @param string|int $taxonomyTermID
     */
    protected function validateEntityExists($taxonomyTermID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateTaxonomyTermByIDExists($taxonomyTermID, null, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $taxonomyTermID
     */
    protected function validateUserCanEditEntity($taxonomyTermID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $taxonomyName = $this->getTaxonomyTermTypeAPI()->getTaxonomyTermTaxonomy($taxonomyTermID);
        if ($taxonomyName === null) {
            return;
        }
        $this->validateCanLoggedInUserEditTaxonomy($taxonomyName, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateSetMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TaxonomyMetaCRUDHookNames::VALIDATE_SET_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateSetMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateAddMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TaxonomyMetaCRUDHookNames::VALIDATE_ADD_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateAddMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateUpdateMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TaxonomyMetaCRUDHookNames::VALIDATE_UPDATE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateUpdateMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateDeleteMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TaxonomyMetaCRUDHookNames::VALIDATE_DELETE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateDeleteMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getSetMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getSetMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(TaxonomyMetaCRUDHookNames::GET_SET_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getAddMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getAddMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(TaxonomyMetaCRUDHookNames::GET_ADD_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getUpdateMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getUpdateMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(TaxonomyMetaCRUDHookNames::GET_UPDATE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getDeleteMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getDeleteMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(TaxonomyMetaCRUDHookNames::GET_DELETE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return string|int The ID of the taxonomy term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    protected function addMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::addMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TaxonomyMetaCRUDHookNames::EXECUTE_ADD_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $taxonomyTermID;
    }
    /**
     * @return string|int the ID of the created taxonomy
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    protected function executeAddEntityMeta($taxonomyTermID, string $key, $value, bool $single)
    {
        return $this->getTaxonomyMetaTypeMutationAPI()->addTaxonomyTermMeta($taxonomyTermID, $key, $value, $single);
    }
    /**
     * @return string|int The ID of the taxonomy term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     */
    protected function updateMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::updateMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TaxonomyMetaCRUDHookNames::EXECUTE_UPDATE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $taxonomyTermID;
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($taxonomyTermID, string $key, $value, $prevValue = null)
    {
        return $this->getTaxonomyMetaTypeMutationAPI()->updateTaxonomyTermMeta($taxonomyTermID, $key, $value, $prevValue);
    }
    /**
     * @return string|int The ID of the taxonomy term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     */
    protected function deleteMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::deleteMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TaxonomyMetaCRUDHookNames::EXECUTE_DELETE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $taxonomyTermID;
    }
    /**
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($taxonomyTermID, string $key, $value = null) : void
    {
        $this->getTaxonomyMetaTypeMutationAPI()->deleteTaxonomyTermMeta($taxonomyTermID, $key, $value);
    }
    /**
     * @return string|int The ID of the taxonomy term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     */
    protected function setMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::setMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TaxonomyMetaCRUDHookNames::EXECUTE_SET_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $taxonomyTermID;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    protected function executeSetEntityMeta($taxonomyTermID, array $entries) : void
    {
        $this->getTaxonomyMetaTypeMutationAPI()->setTaxonomyTermMeta($taxonomyTermID, $entries);
    }
}
