<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateOrUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostTagMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostTagMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\Exception\AbstractException;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use stdClass;
abstract class AbstractSetTagsOnCustomPostMutationResolver extends AbstractMutationResolver
{
    use CreateOrUpdateCustomPostMutationResolverTrait;
    use \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostMutationResolverTrait;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    /**
     * @var \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface|null
     */
    private $userRoleTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface|null
     */
    private $customPostTypeMutationAPI;
    public final function setNameResolver(NameResolverInterface $nameResolver) : void
    {
        $this->nameResolver = $nameResolver;
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
    public final function setUserRoleTypeAPI(UserRoleTypeAPIInterface $userRoleTypeAPI) : void
    {
        $this->userRoleTypeAPI = $userRoleTypeAPI;
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
    public final function setCustomPostTypeAPI(CustomPostTypeAPIInterface $customPostTypeAPI) : void
    {
        $this->customPostTypeAPI = $customPostTypeAPI;
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
    public final function setCustomPostTypeMutationAPI(CustomPostTypeMutationAPIInterface $customPostTypeMutationAPI) : void
    {
        $this->customPostTypeMutationAPI = $customPostTypeMutationAPI;
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
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        /** @var stdClass|null */
        $tagsBy = $fieldDataAccessor->getValue(MutationInputProperties::TAGS_BY);
        if ($tagsBy === null || (array) $tagsBy === []) {
            return $customPostID;
        }
        $postTags = isset($tagsBy->{MutationInputProperties::IDS}) ? $tagsBy->{MutationInputProperties::IDS} : $tagsBy->{MutationInputProperties::SLUGS};
        $append = $fieldDataAccessor->getValue(MutationInputProperties::APPEND);
        $customPostTagTypeAPI = $this->getCustomPostTagTypeMutationAPI();
        $customPostTagTypeAPI->setTags($customPostID, $postTags, $append);
        return $customPostID;
    }
    protected abstract function getCustomPostTagTypeMutationAPI() : CustomPostTagTypeMutationAPIInterface;
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsUserLoggedIn($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        $this->validateCustomPostExists($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        /** @var stdClass */
        $tagsBy = $fieldDataAccessor->getValue(MutationInputProperties::TAGS_BY);
        if (isset($tagsBy->{MutationInputProperties::IDS})) {
            $customPostTagIDs = $tagsBy->{MutationInputProperties::IDS};
            $this->validateTagsExist($customPostTagIDs, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
            if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
                return;
            }
        }
        $this->validateCanLoggedInUserEditCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPost($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
    protected function getEntityName() : string
    {
        return $this->__('custom post', 'custompost-tag-mutations');
    }
}
