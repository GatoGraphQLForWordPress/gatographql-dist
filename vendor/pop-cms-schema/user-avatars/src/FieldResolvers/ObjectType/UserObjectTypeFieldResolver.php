<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserAvatars\FieldResolvers\ObjectType;

use PoPCMSSchema\UserAvatars\Module;
use PoPCMSSchema\UserAvatars\ModuleConfiguration;
use PoPCMSSchema\UserAvatars\ObjectModels\UserAvatar;
use PoPCMSSchema\UserAvatars\RuntimeRegistries\UserAvatarRuntimeRegistryInterface;
use PoPCMSSchema\UserAvatars\TypeAPIs\UserAvatarTypeAPIInterface;
use PoPCMSSchema\UserAvatars\TypeResolvers\ObjectType\UserAvatarObjectTypeResolver;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
/** @internal */
class UserObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserAvatars\TypeAPIs\UserAvatarTypeAPIInterface|null
     */
    private $userAvatarTypeAPI;
    /**
     * @var \PoPCMSSchema\UserAvatars\RuntimeRegistries\UserAvatarRuntimeRegistryInterface|null
     */
    private $userAvatarRuntimeRegistry;
    /**
     * @var \PoPCMSSchema\UserAvatars\TypeResolvers\ObjectType\UserAvatarObjectTypeResolver|null
     */
    private $userAvatarObjectTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    protected final function getUserAvatarTypeAPI() : UserAvatarTypeAPIInterface
    {
        if ($this->userAvatarTypeAPI === null) {
            /** @var UserAvatarTypeAPIInterface */
            $userAvatarTypeAPI = $this->instanceManager->getInstance(UserAvatarTypeAPIInterface::class);
            $this->userAvatarTypeAPI = $userAvatarTypeAPI;
        }
        return $this->userAvatarTypeAPI;
    }
    protected final function getUserAvatarRuntimeRegistry() : UserAvatarRuntimeRegistryInterface
    {
        if ($this->userAvatarRuntimeRegistry === null) {
            /** @var UserAvatarRuntimeRegistryInterface */
            $userAvatarRuntimeRegistry = $this->instanceManager->getInstance(UserAvatarRuntimeRegistryInterface::class);
            $this->userAvatarRuntimeRegistry = $userAvatarRuntimeRegistry;
        }
        return $this->userAvatarRuntimeRegistry;
    }
    protected final function getUserAvatarObjectTypeResolver() : UserAvatarObjectTypeResolver
    {
        if ($this->userAvatarObjectTypeResolver === null) {
            /** @var UserAvatarObjectTypeResolver */
            $userAvatarObjectTypeResolver = $this->instanceManager->getInstance(UserAvatarObjectTypeResolver::class);
            $this->userAvatarObjectTypeResolver = $userAvatarObjectTypeResolver;
        }
        return $this->userAvatarObjectTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [UserObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['avatar'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'avatar':
                return $this->__('User avatar', 'user-avatars');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'avatar':
                return ['size' => $this->getIntScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['avatar' => 'size']:
                return $this->__('Avatar size', 'user-avatars');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName)
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        switch ([$fieldName => $fieldArgName]) {
            case ['avatar' => 'size']:
                return $moduleConfiguration->getUserAvatarDefaultSize();
            default:
                return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['avatar' => 'size']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $user = $object;
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        switch ($fieldDataAccessor->getFieldName()) {
            case 'avatar':
                // Create the avatar, and store it in the dynamic registry
                $avatarSize = $fieldDataAccessor->getValue('size') ?? $moduleConfiguration->getUserAvatarDefaultSize();
                $avatarSrc = $this->getUserAvatarTypeAPI()->getUserAvatarSrc($user, $avatarSize);
                if ($avatarSrc === null) {
                    return null;
                }
                $avatarIDComponents = ['src' => $avatarSrc, 'size' => $avatarSize];
                // Generate a hash to represent the ID of the avatar given its properties
                $avatarID = \hash('md5', (string) \json_encode($avatarIDComponents));
                $this->getUserAvatarRuntimeRegistry()->storeUserAvatar(new UserAvatar($avatarID, $avatarSrc, $avatarSize));
                return $avatarID;
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
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'avatar':
                return $this->getUserAvatarObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
