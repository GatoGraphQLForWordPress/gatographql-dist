<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ConditionalOnModule\CustomPostMutations\Hooks;

use PoPCMSSchema\CustomPostMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateOrUpdateCustomPostMutationResolverTrait;
use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\MediaMutations\ConditionalOnModule\CustomPostMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MediaMutations\Constants\HookNames;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
/** @internal */
class MutationResolverHookSet extends AbstractHookSet
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
     * @var \PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface|null
     */
    private $customPostTypeMutationAPI;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
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
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    protected function init() : void
    {
        App::addAction(HookNames::VALIDATE_CREATE_OR_UPDATE_MEDIA_ITEM, \Closure::fromCallable([$this, 'maybeValidateCustomPost']), 10, 2);
        App::addFilter(HookNames::GET_CREATE_OR_UPDATE_MEDIA_ITEM_DATA, \Closure::fromCallable([$this, 'addCreateOrUpdateMediaItemData']), 10, 2);
        App::addFilter(HookNames::CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS, \Closure::fromCallable([$this, 'getInputFieldNameTypeResolvers']));
        App::addFilter(HookNames::CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION, \Closure::fromCallable([$this, 'getInputFieldDescription']), 10, 2);
        App::addFilter(HookNames::ERROR_PAYLOAD, \Closure::fromCallable([$this, 'createErrorPayloadFromObjectTypeFieldResolutionFeedback']), 10, 2);
    }
    public function maybeValidateCustomPost(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
        if ($customPostID === null) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPosts($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        // Make sure the custom post exists
        $this->validateCustomPostExists($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditCustomPost($customPostID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param array<string,mixed> $mediaItemData
     * @return array<string,mixed>
     */
    public function addCreateOrUpdateMediaItemData(array $mediaItemData, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        // customPostID can be `null`
        if ($fieldDataAccessor->hasValue(MutationInputProperties::CUSTOMPOST_ID)) {
            $customPostID = $fieldDataAccessor->getValue(MutationInputProperties::CUSTOMPOST_ID);
            $mediaItemData['customPostID'] = $customPostID;
        }
        return $mediaItemData;
    }
    /**
     * @param array<string,InputTypeResolverInterface> $inputFieldNameTypeResolvers
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(array $inputFieldNameTypeResolvers) : array
    {
        $inputFieldNameTypeResolvers[MutationInputProperties::CUSTOMPOST_ID] = $this->getIDScalarTypeResolver();
        return $inputFieldNameTypeResolvers;
    }
    public function getInputFieldDescription(?string $inputFieldDescription, string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_ID:
                return $this->__('ID of the custom post under which to upload the attachment', 'media-mutations');
            default:
                return $inputFieldDescription;
        }
    }
    public function createErrorPayloadFromObjectTypeFieldResolutionFeedback(ErrorPayloadInterface $errorPayload, ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new CustomPostDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            default:
                return $errorPayload;
        }
    }
}
