<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMedia\TypeAPIs\CustomPostMediaTypeAPIInterface;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateOrUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
abstract class AbstractSetOrRemoveFeaturedImageOnCustomPostMutationResolver extends AbstractMutationResolver
{
    use CreateOrUpdateCustomPostMutationResolverTrait;
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
     * @var \PoPCMSSchema\CustomPostMedia\TypeAPIs\CustomPostMediaTypeAPIInterface|null
     */
    private $customPostMediaTypeAPI;
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
    public final function setCustomPostMediaTypeAPI(CustomPostMediaTypeAPIInterface $customPostMediaTypeAPI) : void
    {
        $this->customPostMediaTypeAPI = $customPostMediaTypeAPI;
    }
    protected final function getCustomPostMediaTypeAPI() : CustomPostMediaTypeAPIInterface
    {
        if ($this->customPostMediaTypeAPI === null) {
            /** @var CustomPostMediaTypeAPIInterface */
            $customPostMediaTypeAPI = $this->instanceManager->getInstance(CustomPostMediaTypeAPIInterface::class);
            $this->customPostMediaTypeAPI = $customPostMediaTypeAPI;
        }
        return $this->customPostMediaTypeAPI;
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
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3);
    }
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsUserLoggedIn($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        $this->validateCustomPostExists($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateDoesCustomPostTypeSupportFeaturedImage($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        $this->validateCanLoggedInUserEditCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPost($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $customPostID
     */
    protected function validateDoesCustomPostTypeSupportFeaturedImage($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        /** @var string */
        $customPostType = $this->getCustomPostTypeAPI()->getCustomPostType($customPostID);
        if (!$this->getCustomPostMediaTypeAPI()->doesCustomPostTypeSupportFeaturedImage($customPostType)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4, [$customPostType]), $fieldDataAccessor->getField()));
        }
    }
}
