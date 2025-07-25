<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\CommentMetaMutations\Constants\CommentMetaCRUDHookNames;
use PoPCMSSchema\CommentMetaMutations\Exception\CommentMetaCRUDMutationException;
use PoPCMSSchema\CommentMetaMutations\TypeAPIs\CommentMetaTypeMutationAPIInterface;
use PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface;
use PoPCMSSchema\CommentMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CommentMutations\TypeAPIs\CommentTypeMutationAPIInterface;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\MutationResolvers\AbstractMutateEntityMetaMutationResolver;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\App;
/** @internal */
abstract class AbstractMutateCommentMetaMutationResolver extends AbstractMutateEntityMetaMutationResolver implements \PoPCMSSchema\CommentMetaMutations\MutationResolvers\CommentMetaMutationResolverInterface
{
    use \PoPCMSSchema\CommentMetaMutations\MutationResolvers\MutateCommentMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface|null
     */
    private $commentMetaTypeAPI;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeAPIs\CommentMetaTypeMutationAPIInterface|null
     */
    private $commentMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    /**
     * @var \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface|null
     */
    private $userRoleTypeAPI;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeAPIs\CommentTypeMutationAPIInterface|null
     */
    private $commentTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface|null
     */
    private $customPostTypeMutationAPI;
    protected final function getCommentMetaTypeAPI() : CommentMetaTypeAPIInterface
    {
        if ($this->commentMetaTypeAPI === null) {
            /** @var CommentMetaTypeAPIInterface */
            $commentMetaTypeAPI = $this->instanceManager->getInstance(CommentMetaTypeAPIInterface::class);
            $this->commentMetaTypeAPI = $commentMetaTypeAPI;
        }
        return $this->commentMetaTypeAPI;
    }
    protected final function getCommentMetaTypeMutationAPI() : CommentMetaTypeMutationAPIInterface
    {
        if ($this->commentMetaTypeMutationAPI === null) {
            /** @var CommentMetaTypeMutationAPIInterface */
            $commentMetaTypeMutationAPI = $this->instanceManager->getInstance(CommentMetaTypeMutationAPIInterface::class);
            $this->commentMetaTypeMutationAPI = $commentMetaTypeMutationAPI;
        }
        return $this->commentMetaTypeMutationAPI;
    }
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
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
    protected final function getCommentTypeMutationAPI() : CommentTypeMutationAPIInterface
    {
        if ($this->commentTypeMutationAPI === null) {
            /** @var CommentTypeMutationAPIInterface */
            $commentTypeMutationAPI = $this->instanceManager->getInstance(CommentTypeMutationAPIInterface::class);
            $this->commentTypeMutationAPI = $commentTypeMutationAPI;
        }
        return $this->commentTypeMutationAPI;
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
     * @param string|int $commentID
     */
    protected function validateEntityExists($commentID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $comment = $this->getCommentTypeAPI()->getComment($commentID);
        if ($comment !== null) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E10, [$commentID]), $fieldDataAccessor->getField()));
    }
    /**
     * @param string|int $commentID
     */
    protected function validateUserCanEditEntity($commentID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        /**
         * As solution, check if the user can edit the custom post
         * where the comment was added
         *
         * @var object
         */
        $comment = $this->getCommentTypeAPI()->getComment($commentID);
        $customPostID = $this->getCommentTypeAPI()->getCommentCustomPostID($comment);
        $userID = App::getState('current-user-id');
        if ($this->getCustomPostTypeMutationAPI()->canUserEditCustomPost($userID, $customPostID)) {
            return;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E11, [$commentID]), $fieldDataAccessor->getField()));
    }
    protected function validateSetMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentMetaCRUDHookNames::VALIDATE_SET_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateSetMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateAddMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentMetaCRUDHookNames::VALIDATE_ADD_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateAddMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateUpdateMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentMetaCRUDHookNames::VALIDATE_UPDATE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateUpdateMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateDeleteMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentMetaCRUDHookNames::VALIDATE_DELETE_META, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        parent::validateDeleteMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getSetMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getSetMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CommentMetaCRUDHookNames::GET_SET_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getAddMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getAddMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CommentMetaCRUDHookNames::GET_ADD_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getUpdateMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getUpdateMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CommentMetaCRUDHookNames::GET_UPDATE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return array<string,mixed>
     */
    protected function getDeleteMetaData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $metaData = parent::getDeleteMetaData($fieldDataAccessor);
        $metaData = App::applyFilters(CommentMetaCRUDHookNames::GET_DELETE_META_DATA, $metaData, $fieldDataAccessor);
        return $metaData;
    }
    /**
     * @return string|int The ID of the comment
     * @throws CommentMetaCRUDMutationException If there was an error (eg: some comment creation validation failed)
     */
    protected function addMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $commentID = parent::addMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CommentMetaCRUDHookNames::EXECUTE_ADD_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $commentID;
    }
    /**
     * @return string|int the ID of the created comment
     * @throws CommentMetaCRUDMutationException If there was an error (eg: some comment creation validation failed)
     * @param string|int $commentID
     * @param mixed $value
     */
    protected function executeAddEntityMeta($commentID, string $key, $value, bool $single)
    {
        return $this->getCommentMetaTypeMutationAPI()->addCommentMeta($commentID, $key, $value, $single);
    }
    /**
     * @return string|int The ID of the comment
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     */
    protected function updateMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $commentID = parent::updateMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CommentMetaCRUDHookNames::EXECUTE_UPDATE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $commentID;
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     * @param string|int $commentID
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($commentID, string $key, $value, $prevValue = null)
    {
        return $this->getCommentMetaTypeMutationAPI()->updateCommentMeta($commentID, $key, $value, $prevValue);
    }
    /**
     * @return string|int The ID of the comment
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     */
    protected function deleteMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $commentID = parent::deleteMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CommentMetaCRUDHookNames::EXECUTE_DELETE_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $commentID;
    }
    /**
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     * @param string|int $commentID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($commentID, string $key, $value = null) : void
    {
        $this->getCommentMetaTypeMutationAPI()->deleteCommentMeta($commentID, $key, $value);
    }
    /**
     * @return string|int The ID of the comment
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     */
    protected function setMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $commentID = parent::setMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(CommentMetaCRUDHookNames::EXECUTE_SET_META, $fieldDataAccessor->getValue(MutationInputProperties::ID), $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $commentID;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     * @param string|int $commentID
     */
    protected function executeSetEntityMeta($commentID, array $entries) : void
    {
        $this->getCommentMetaTypeMutationAPI()->setCommentMeta($commentID, $entries);
    }
}
