<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CommentMutations\Exception\CommentCRUDMutationException;
use PoPCMSSchema\CommentMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMutations\TypeAPIs\CommentTypeMutationAPIInterface;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\UserStateMutations\MutationResolvers\ValidateUserLoggedInMutationResolverTrait;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\HelperServices\RequestHelperServiceInterface;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Exception\AbstractException;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoPCMSSchema\CommentMutations\Constants\CommentCRUDHookNames;
use stdClass;
/**
 * Add a comment to a custom post. The user may be logged-in or not
 * @internal
 */
class AddCommentToCustomPostMutationResolver extends AbstractMutationResolver
{
    use ValidateUserLoggedInMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeAPIs\CommentTypeMutationAPIInterface|null
     */
    private $commentTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoP\ComponentModel\HelperServices\RequestHelperServiceInterface|null
     */
    private $requestHelperService;
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
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
    protected final function getUserTypeAPI() : UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
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
    protected final function getRequestHelperService() : RequestHelperServiceInterface
    {
        if ($this->requestHelperService === null) {
            /** @var RequestHelperServiceInterface */
            $requestHelperService = $this->instanceManager->getInstance(RequestHelperServiceInterface::class);
            $this->requestHelperService = $requestHelperService;
        }
        return $this->requestHelperService;
    }
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $field = $fieldDataAccessor->getField();
        // Check that the user is logged-in
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->mustUserBeLoggedInToAddComment()) {
            $errorFeedbackItemResolution = $this->validateUserIsLoggedIn();
            if ($errorFeedbackItemResolution !== null) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($errorFeedbackItemResolution, $field));
                return;
            }
        } elseif ($moduleConfiguration->requireCommenterNameAndEmail()) {
            // Validate if the commenter's name and email are mandatory
            if (!$fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_NAME)) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2), $field));
            }
            if (!$fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_EMAIL)) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3), $field));
            }
        }
        // Either provide the customPostID, or retrieve it from the parent comment
        if (!$fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID) && !$fieldDataAccessor->getValue(MutationInputProperties::PARENT_COMMENT_ID)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4), $field));
        }
        // Make sure the parent comment exists
        // Either provide the customPostID, or retrieve it from the parent comment
        if ($parentCommentID = $fieldDataAccessor->getValue(MutationInputProperties::PARENT_COMMENT_ID)) {
            $parentComment = $this->getCommentTypeAPI()->getComment($parentCommentID);
            if ($parentComment === null) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6, [$parentCommentID]), $field));
            }
        }
        // Make sure the custom post exists
        if ($customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID)) {
            if (!$this->getCustomPostTypeAPI()->customPostExists($customPostID)) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7, [$customPostID]), $field));
            } else {
                // Validate the corresponding CPT supports comments
                /** @var string */
                $customPostType = $this->getCustomPostTypeAPI()->getCustomPostType($customPostID);
                if (!$this->getCommentTypeAPI()->doesCustomPostTypeSupportComments($customPostType)) {
                    $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8, [$customPostType]), $field));
                } elseif (!$this->getCommentTypeAPI()->areCommentsOpen($customPostID)) {
                    $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9, [$customPostID]), $field));
                }
            }
        }
        /** @var stdClass */
        $commentAs = $fieldDataAccessor->getValue(MutationInputProperties::COMMENT_AS);
        /**
         * @todo In addition to "html", support additional oneof properties for the mutation (eg: provide "blocks" for Gutenberg)
         */
        if (!$commentAs->{MutationInputProperties::HTML}) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5), $field));
        }
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->triggerValidateAddCommentHook($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function triggerValidateAddCommentHook(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentCRUDHookNames::VALIDATE_ADD_COMMENT, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
    /**
     * @param string|int $comment_id
     */
    protected function additionals($comment_id, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        App::doAction(CommentCRUDHookNames::EXECUTE_ADD_COMMENT, $comment_id, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getCommentData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        /** @var stdClass */
        $commentAs = $fieldDataAccessor->getValue(MutationInputProperties::COMMENT_AS);
        $comment_data = [
            'authorIP' => $this->getRequestHelperService()->getClientIPAddress(),
            'agent' => App::server('HTTP_USER_AGENT'),
            /**
             * @todo In addition to "html", support additional oneof properties for the mutation (eg: provide "blocks" for Gutenberg)
             */
            'content' => $commentAs->{MutationInputProperties::HTML},
            'parent' => $fieldDataAccessor->getValue(MutationInputProperties::PARENT_COMMENT_ID),
            'customPostID' => $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID),
        ];
        /**
         * Override with the user's properties
         */
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->mustUserBeLoggedInToAddComment()) {
            $userID = App::getState('current-user-id');
            $comment_data['userID'] = $userID;
            $comment_data['author'] = $this->getUserTypeAPI()->getUserDisplayName($userID);
            $comment_data['authorEmail'] = $this->getUserTypeAPI()->getUserEmail($userID);
            $comment_data['authorURL'] = $this->getUserTypeAPI()->getUserWebsiteURL($userID);
        } else {
            if ($userID = App::getState('current-user-id')) {
                $comment_data['userID'] = $userID;
            }
            $comment_data['author'] = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_NAME);
            $comment_data['authorEmail'] = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_EMAIL);
            $comment_data['authorURL'] = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_URL);
        }
        // If the parent comment is provided and the custom post is not,
        // then retrieve it from there
        if ($comment_data['parent'] && !$comment_data['customPostID']) {
            /** @var object */
            $parentComment = $this->getCommentTypeAPI()->getComment($comment_data['parent']);
            $comment_data['customPostID'] = $this->getCommentTypeAPI()->getCommentCustomPostID($parentComment);
        }
        return App::applyFilters(CommentCRUDHookNames::GET_ADD_COMMENT_DATA, $comment_data, $fieldDataAccessor);
    }
    /**
     * @throws CommentCRUDMutationException In case of error
     * @param array<string,mixed> $comment_data
     * @return string|int
     */
    protected function insertComment(array $comment_data)
    {
        return $this->getCommentTypeMutationAPI()->insertComment($comment_data);
    }
    /**
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $comment_data = $this->getCommentData($fieldDataAccessor);
        $comment_id = $this->insertComment($comment_data);
        // Allow for additional operations (eg: set Action categories)
        $this->additionals($comment_id, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        return $comment_id;
    }
}
