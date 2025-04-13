<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMetaMutations\Constants\CustomPostMetaCRUDHookNames;
use PoPCMSSchema\CustomPostMetaMutations\Exception\CustomPostMetaCRUDMutationException;
use PoPCMSSchema\CustomPostMetaMutations\TypeAPIs\CustomPostMetaTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMeta\TypeAPIs\CustomPostMetaTypeAPIInterface;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateOrUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\MutationResolvers\AbstractMutateEntityMetaMutationResolver;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\App;
/** @internal */
abstract class AbstractMutateCustomPostMetaMutationResolver extends AbstractMutateEntityMetaMutationResolver implements \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\CustomPostMetaMutationResolverInterface
{
    use CreateOrUpdateCustomPostMutationResolverTrait;
    use \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\MutateCustomPostMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPostMeta\TypeAPIs\CustomPostMetaTypeAPIInterface|null
     */
    private $customPostMetaTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeAPIs\CustomPostMetaTypeMutationAPIInterface|null
     */
    private $customPostMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    /**
     * @var \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface|null
     */
    private $userRoleTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface|null
     */
    private $customPostTypeMutationAPI;
    protected final function getCustomPostMetaTypeAPI() : CustomPostMetaTypeAPIInterface
    {
        if ($this->customPostMetaTypeAPI === null) {
            /** @var CustomPostMetaTypeAPIInterface */
            $customPostMetaTypeAPI = $this->instanceManager->getInstance(CustomPostMetaTypeAPIInterface::class);
            $this->customPostMetaTypeAPI = $customPostMetaTypeAPI;
        }
        return $this->customPostMetaTypeAPI;
    }
    protected final function getCustomPostMetaTypeMutationAPI() : CustomPostMetaTypeMutationAPIInterface
    {
        if ($this->customPostMetaTypeMutationAPI === null) {
            /** @var CustomPostMetaTypeMutationAPIInterface */
            $customPostMetaTypeMutationAPI = $this->instanceManager->getInstance(CustomPostMetaTypeMutationAPIInterface::class);
            $this->customPostMetaTypeMutationAPI = $customPostMetaTypeMutationAPI;
        }
        return $this->customPostMetaTypeMutationAPI;
    }
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
    }
    protected final function getNameResolver() : NameResolverInterface
    {
        if ($this->nameResolver === null) {
            /** @var NameResolverInterface */
            $nameResolver = $this->instanceManager->getInstance(NameResolverInterface::class);
            $this->nameResolver = $nameResolver;
        }
        return $this->nameResolver;
    }
    protected final function getUserRoleTypeAPI() : UserRoleTypeAPIInterface
    {
        if ($this->userRoleTypeAPI === null) {
            /** @var UserRoleTypeAPIInterface */
            $userRoleTypeAPI = $this->instanceManager->getInstance(UserRoleTypeAPIInterface::class);
            $this->userRoleTypeAPI = $userRoleTypeAPI;
        }
        return $this->userRoleTypeAPI;
    }
    protected final function getCustomPostTypeMutationAPI() : CustomPostTypeMutationAPIInterface
    {
        if ($this->customPostTypeMutationAPI === null) {
            /** @var CustomPostTypeMutationAPIInterface */
            $customPostTypeMutationAPI = $this->instanceManager->getInstance(CustomPostTypeMutationAPIInterface::class);
            $this->customPostTypeMutationAPI = $customPostTypeMutationAPI;
        }
        return $this->customPostTypeMutationAPI;
    }
    /**
     * @param string|int $customPostID
     */
    protected function validateEntityExists($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateCustomPostExists($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $customPostID
     */
    protected function validateUserCanEditEntity($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateCanLoggedInUserEditCustomPost($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateSetMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CustomPostMetaCRUDHookNames::VALIDATE_SET_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateSetMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateAddMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CustomPostMetaCRUDHookNames::VALIDATE_ADD_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateAddMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateUpdateMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CustomPostMetaCRUDHookNames::VALIDATE_UPDATE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateUpdateMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateDeleteMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CustomPostMetaCRUDHookNames::VALIDATE_DELETE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateDeleteMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getSetMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getSetMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CustomPostMetaCRUDHookNames::GET_SET_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getAddMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getAddMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CustomPostMetaCRUDHookNames::GET_ADD_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getUpdateMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getUpdateMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CustomPostMetaCRUDHookNames::GET_UPDATE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getDeleteMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getDeleteMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CustomPostMetaCRUDHookNames::GET_DELETE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return string|int The ID of the custom post
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: some custom post creation validation failed)
     */
    protected function addMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $customPostID = parent::addMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CustomPostMetaCRUDHookNames::EXECUTE_ADD_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $customPostID;
    }
    /**
     * @return string|int the ID of the created custom post
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: some custom post creation validation failed)
     * @param string|int $customPostID
     * @param mixed $value
     */
    protected function executeAddEntityMeta($customPostID, string $key, $value, bool $single)
    {
        return $this->getCustomPostMetaTypeMutationAPI()->addCustomPostMeta($customPostID, $key, $value, $single);
    }
    /**
     * @return string|int The ID of the custom post
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     */
    protected function updateMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $customPostID = parent::updateMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CustomPostMetaCRUDHookNames::EXECUTE_UPDATE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $customPostID;
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($customPostID, string $key, $value, $prevValue = null)
    {
        return $this->getCustomPostMetaTypeMutationAPI()->updateCustomPostMeta($customPostID, $key, $value, $prevValue);
    }
    /**
     * @return string|int The ID of the custom post
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     */
    protected function deleteMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $customPostID = parent::deleteMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CustomPostMetaCRUDHookNames::EXECUTE_DELETE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $customPostID;
    }
    /**
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($customPostID, string $key, $value = null) : void
    {
        $this->getCustomPostMetaTypeMutationAPI()->deleteCustomPostMeta($customPostID, $key, $value);
    }
    /**
     * @return string|int The ID of the custom post
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     */
    protected function setMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $customPostID = parent::setMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CustomPostMetaCRUDHookNames::EXECUTE_SET_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $customPostID;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     */
    protected function executeSetEntityMeta($customPostID, array $entries) : void
    {
        $this->getCustomPostMetaTypeMutationAPI()->setCustomPostMeta($customPostID, $entries);
    }
}
