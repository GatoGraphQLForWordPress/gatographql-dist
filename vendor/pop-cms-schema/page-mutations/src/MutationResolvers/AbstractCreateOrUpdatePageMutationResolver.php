<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateCustomPostMutationResolver;
use PoPCMSSchema\PageMutations\Constants\PageCRUDHookNames;
use PoPCMSSchema\PageMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\PageMutations\LooseContracts\LooseContractSet;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
/** @internal */
abstract class AbstractCreateOrUpdatePageMutationResolver extends AbstractCreateOrUpdateCustomPostMutationResolver
{
    /**
     * @var \PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface|null
     */
    private $pageTypeAPI;
    protected final function getPageTypeAPI() : PageTypeAPIInterface
    {
        if ($this->pageTypeAPI === null) {
            /** @var PageTypeAPIInterface */
            $pageTypeAPI = $this->instanceManager->getInstance(PageTypeAPIInterface::class);
            $this->pageTypeAPI = $pageTypeAPI;
        }
        return $this->pageTypeAPI;
    }
    public function getCustomPostType() : string
    {
        return $this->getPageTypeAPI()->getPageCustomPostType();
    }
    protected function validateCanLoggedInUserEditCustomPosts(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        // Validate user permission
        $userID = App::getState('current-user-id');
        $editPagesCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_EDIT_PAGES_CAPABILITY);
        if (!$this->getUserRoleTypeAPI()->userCan($userID, $editPagesCapability)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2), $fieldDataAccessor->getField()));
        }
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        parent::validateCanLoggedInUserEditCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function validateCanLoggedInUserPublishCustomPosts(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $userID = App::getState('current-user-id');
        $publishPagesCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_PUBLISH_PAGES_CAPABILITY);
        if (!$this->getUserRoleTypeAPI()->userCan($userID, $publishPagesCapability)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E3), $fieldDataAccessor->getField()));
        }
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        parent::validateCanLoggedInUserPublishCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function triggerValidateCreateOrUpdateHook(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerValidateCreateOrUpdateHook($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::VALIDATE_CREATE_OR_UPDATE, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected function triggerValidateCreateHook(string $customPostType, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerValidateCreateHook($customPostType, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::VALIDATE_CREATE, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore, $customPostType);
    }
    /**
     * @param string|int $customPostID
     */
    protected function triggerValidateUpdateHook($customPostID, string $customPostType, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerValidateUpdateHook($customPostID, $customPostType, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::VALIDATE_UPDATE, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore, $customPostType, $customPostID);
    }
    /**
     * @param array<string,mixed> $customPostData
     * @return array<string,mixed>
     */
    protected function addCreateOrUpdateCustomPostData(array $customPostData, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        return App::applyFilters(PageCRUDHookNames::GET_CREATE_OR_UPDATE_DATA, parent::addCreateOrUpdateCustomPostData($customPostData, $fieldDataAccessor), $fieldDataAccessor);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getUpdateCustomPostData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        return App::applyFilters(PageCRUDHookNames::GET_UPDATE_DATA, parent::getUpdateCustomPostData($fieldDataAccessor), $fieldDataAccessor);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getCreateCustomPostData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        return App::applyFilters(PageCRUDHookNames::GET_CREATE_DATA, parent::getCreateCustomPostData($fieldDataAccessor), $fieldDataAccessor);
    }
    /**
     * @param string|int $customPostID
     */
    protected function triggerExecuteCreateOrUpdateHook($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerExecuteCreateOrUpdateHook($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::EXECUTE_CREATE_OR_UPDATE, $customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $customPostID
     */
    protected function triggerExecuteUpdateHook($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerExecuteUpdateHook($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::EXECUTE_UPDATE, $customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $customPostID
     */
    protected function triggerExecuteCreateHook($customPostID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::triggerExecuteCreateHook($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        App::doAction(PageCRUDHookNames::EXECUTE_CREATE, $customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
