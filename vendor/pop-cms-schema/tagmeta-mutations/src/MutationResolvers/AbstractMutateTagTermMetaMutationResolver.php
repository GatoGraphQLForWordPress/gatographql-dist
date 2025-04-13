<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\TagMetaMutations\Constants\TagMetaCRUDHookNames;
use PoPCMSSchema\TagMetaMutations\Exception\TagTermMetaCRUDMutationException;
use PoPCMSSchema\TagMetaMutations\TypeAPIs\TagMetaTypeMutationAPIInterface;
use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\Exception\TaxonomyTermMetaCRUDMutationException;
use PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers\AbstractMutateTaxonomyTermMetaMutationResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
/** @internal */
abstract class AbstractMutateTagTermMetaMutationResolver extends AbstractMutateTaxonomyTermMetaMutationResolver implements \PoPCMSSchema\TagMetaMutations\MutationResolvers\TagTermMetaMutationResolverInterface
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeAPIs\TagMetaTypeMutationAPIInterface|null
     */
    private $tagTypeMutationAPI;
    protected final function getTagMetaTypeMutationAPI() : TagMetaTypeMutationAPIInterface
    {
        if ($this->tagTypeMutationAPI === null) {
            /** @var TagMetaTypeMutationAPIInterface */
            $tagTypeMutationAPI = $this->instanceManager->getInstance(TagMetaTypeMutationAPIInterface::class);
            $this->tagTypeMutationAPI = $tagTypeMutationAPI;
        }
        return $this->tagTypeMutationAPI;
    }
    /**
     * @return string|int the ID of the created meta entry
     * @throws TagTermMetaCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    protected function executeAddEntityMeta($taxonomyTermID, string $key, $value, bool $single)
    {
        return $this->getTagMetaTypeMutationAPI()->addTaxonomyTermMeta($taxonomyTermID, $key, $value, $single);
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws TagTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($taxonomyTermID, string $key, $value, $prevValue = null)
    {
        return $this->getTagMetaTypeMutationAPI()->updateTaxonomyTermMeta($taxonomyTermID, $key, $value, $prevValue);
    }
    /**
     * @throws TagTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($taxonomyTermID, string $key, $value = null) : void
    {
        $this->getTagMetaTypeMutationAPI()->deleteTaxonomyTermMeta($taxonomyTermID, $key, $value);
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws TagTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    protected function executeSetEntityMeta($taxonomyTermID, array $entries) : void
    {
        $this->getTagMetaTypeMutationAPI()->setTaxonomyTermMeta($taxonomyTermID, $entries);
    }
    protected function validateAddMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TagMetaCRUDHookNames::VALIDATE_ADD_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateAddMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateUpdateMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TagMetaCRUDHookNames::VALIDATE_UPDATE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateUpdateMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateDeleteMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TagMetaCRUDHookNames::VALIDATE_DELETE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateDeleteMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateSetMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(TagMetaCRUDHookNames::VALIDATE_SET_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateSetMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getAddMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $taxonomyData = parent::getAddMetaData($fieldDataAccessor);
        $taxonomyData = App::applyFilters(TagMetaCRUDHookNames::GET_ADD_META_DATA, $taxonomyData, $fieldDataAccessor);
        return $taxonomyData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getUpdateMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $taxonomyData = parent::getUpdateMetaData($fieldDataAccessor);
        $taxonomyData = App::applyFilters(TagMetaCRUDHookNames::GET_UPDATE_META_DATA, $taxonomyData, $fieldDataAccessor);
        return $taxonomyData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getDeleteMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $taxonomyData = parent::getDeleteMetaData($fieldDataAccessor);
        $taxonomyData = App::applyFilters(TagMetaCRUDHookNames::GET_DELETE_META_DATA, $taxonomyData, $fieldDataAccessor);
        return $taxonomyData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getSetMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $taxonomyData = parent::getSetMetaData($fieldDataAccessor);
        $taxonomyData = App::applyFilters(TagMetaCRUDHookNames::GET_SET_META_DATA, $taxonomyData, $fieldDataAccessor);
        return $taxonomyData;
    }
    /**
     * @return string|int The ID of the created entity
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    protected function addMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::addMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TagMetaCRUDHookNames::EXECUTE_ADD_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor);
        return $taxonomyTermID;
    }
    /**
     * @return string|int The ID of the updated entity
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     */
    protected function updateMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::updateMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TagMetaCRUDHookNames::EXECUTE_UPDATE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $taxonomyTermID;
    }
    /**
     * @return string|int The ID of the taxonomy term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     */
    protected function deleteMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::deleteMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TagMetaCRUDHookNames::EXECUTE_DELETE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor);
        return $taxonomyTermID;
    }
    /**
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @return string|int
     */
    protected function setMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $taxonomyTermID = parent::setMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(TagMetaCRUDHookNames::EXECUTE_SET_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor);
        return $taxonomyTermID;
    }
}
