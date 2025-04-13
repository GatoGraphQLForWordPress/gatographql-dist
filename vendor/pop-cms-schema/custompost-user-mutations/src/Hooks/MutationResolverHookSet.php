<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostUserMutations\Hooks;

use PoPCMSSchema\CustomPostMutations\Constants\CustomPostCRUDHookNames;
use PoPCMSSchema\CustomPostUserMutations\Constants\MutationInputProperties;
use PoPCMSSchema\UserMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\UserMutations\ObjectModels\UserDoesNotExistErrorPayload;
use PoPCMSSchema\Users\Constants\InputProperties;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use stdClass;
/** @internal */
class MutationResolverHookSet extends AbstractHookSet
{
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    protected final function getUserTypeAPI() : UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
    }
    protected function init() : void
    {
        App::addAction(CustomPostCRUDHookNames::VALIDATE_CREATE_OR_UPDATE, \Closure::fromCallable([$this, 'maybeValidateAuthor']), 10, 2);
        App::addFilter(CustomPostCRUDHookNames::GET_CREATE_OR_UPDATE_DATA, \Closure::fromCallable([$this, 'addCreateOrUpdateCustomPostData']), 10, 2);
        App::addFilter(CustomPostCRUDHookNames::ERROR_PAYLOAD, \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    public function maybeValidateAuthor(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->hasProvidedAuthorInput($fieldDataAccessor)) {
            return;
        }
        /** @var stdClass|null */
        $authorBy = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_BY);
        if ($authorBy === null) {
            return;
        }
        if (isset($authorBy->{InputProperties::ID})) {
            /** @var string|int */
            $authorID = $authorBy->{InputProperties::ID};
            $this->validateUserByIDExists($authorID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        } elseif (isset($authorBy->{InputProperties::USERNAME})) {
            /** @var string */
            $authorUsername = $authorBy->{InputProperties::USERNAME};
            $this->validateUserByUsernameExists($authorUsername, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        } elseif (isset($authorBy->{InputProperties::EMAIL})) {
            /** @var string */
            $authorEmail = $authorBy->{InputProperties::EMAIL};
            $this->validateUserByEmailExists($authorEmail, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    protected function hasProvidedAuthorInput(FieldDataAccessorInterface $fieldDataAccessor) : bool
    {
        if (!$fieldDataAccessor->hasValue(MutationInputProperties::AUTHOR_BY)) {
            return \false;
        }
        /** @var stdClass|null */
        $authorBy = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_BY);
        return isset($authorBy->{InputProperties::ID}) || isset($authorBy->{InputProperties::USERNAME}) || isset($authorBy->{InputProperties::EMAIL});
    }
    /**
     * @param array<string,mixed> $customPostData
     * @return array<string,mixed>
     */
    public function addCreateOrUpdateCustomPostData(array $customPostData, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        if (!$this->hasProvidedAuthorInput($fieldDataAccessor)) {
            return $customPostData;
        }
        $authorID = null;
        $userTypeAPI = $this->getUserTypeAPI();
        /** @var stdClass|null */
        $authorBy = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_BY);
        if (isset($authorBy->{InputProperties::ID})) {
            /** @var string|int */
            $authorID = $authorBy->{InputProperties::ID};
        } elseif (isset($authorBy->{InputProperties::USERNAME})) {
            /** @var string */
            $authorUsername = $authorBy->{InputProperties::USERNAME};
            /** @var object */
            $user = $userTypeAPI->getUserByLogin($authorUsername);
            $authorID = $userTypeAPI->getUserID($user);
        } elseif (isset($authorBy->{InputProperties::EMAIL})) {
            /** @var string */
            $authorEmail = $authorBy->{InputProperties::EMAIL};
            /** @var object */
            $user = $userTypeAPI->getUserByEmail($authorEmail);
            $authorID = $userTypeAPI->getUserID($user);
        }
        /** @var string|int $authorID */
        $customPostData['author-id'] = $authorID;
        return $customPostData;
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1]:
                return new UserDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new UserDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3]:
                return new UserDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            default:
                return $errorPayload;
        }
    }
    /**
     * @param string|int $userID
     */
    protected function validateUserByIDExists($userID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if ($this->getUserTypeAPI()->getUserByID($userID) === null) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1, [$userID]), $fieldDataAccessor->getField()));
        }
    }
    protected function validateUserByUsernameExists(string $username, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if ($this->getUserTypeAPI()->getUserByLogin($username) === null) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2, [$username]), $fieldDataAccessor->getField()));
        }
    }
    protected function validateUserByEmailExists(string $userEmail, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if ($this->getUserTypeAPI()->getUserByEmail($userEmail) === null) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3, [$userEmail]), $fieldDataAccessor->getField()));
        }
    }
}
