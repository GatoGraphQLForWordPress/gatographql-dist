<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ConditionalOnModule\Users\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\Comments\ConditionalOnModule\Users\TypeAPIs\CommentTypeAPIInterface as UserCommentTypeAPIInterface;
use PoPCMSSchema\Comments\FieldResolvers\ObjectType\CommentObjectTypeFieldResolver as UpstreamCommentObjectTypeFieldResolver;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
/**
 * Override fields from the upstream class, getting the data from the user
 * @internal
 */
class CommentObjectTypeFieldResolver extends UpstreamCommentObjectTypeFieldResolver
{
    /**
     * @var UserCommentTypeAPIInterface|null
     */
    private $userCommentTypeAPI;
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    protected final function getUserCommentTypeAPI() : UserCommentTypeAPIInterface
    {
        if ($this->userCommentTypeAPI === null) {
            /** @var UserCommentTypeAPIInterface */
            $userCommentTypeAPI = $this->instanceManager->getInstance(UserCommentTypeAPIInterface::class);
            $this->userCommentTypeAPI = $userCommentTypeAPI;
        }
        return $this->userCommentTypeAPI;
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
    /**
     * Execute before the upstream class
     */
    public function getPriorityToAttachToClasses() : int
    {
        return 20;
    }
    /**
     * Only use it when `mustUserBeLoggedInToAddComment`.
     * Check on runtime (not via container) since this option can be changed in WP.
     */
    public function isServiceEnabled() : bool
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->mustUserBeLoggedInToAddComment();
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['authorName', 'authorURL', 'authorEmail'];
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $comment = $object;
        $commentUserID = $this->getUserCommentTypeAPI()->getCommentUserID($comment);
        /**
         * Check there is an author. Otherwise, let the upstream resolve it
         */
        if ($commentUserID === null) {
            return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'authorName':
                return $this->getUserTypeAPI()->getUserDisplayName($commentUserID);
            case 'authorURL':
                return $this->getUserTypeAPI()->getUserWebsiteURL($commentUserID);
            case 'authorEmail':
                return $this->getUserTypeAPI()->getUserEmail($commentUserID);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
