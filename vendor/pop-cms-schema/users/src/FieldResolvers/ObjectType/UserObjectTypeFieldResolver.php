<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\FieldResolvers\ObjectType;

use PoPCMSSchema\QueriedObject\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldResolver;
use PoPCMSSchema\Users\Module;
use PoPCMSSchema\Users\ModuleConfiguration;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
/** @internal */
class UserObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver|null
     */
    private $emailScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\QueriedObject\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldResolver|null
     */
    private $queryableInterfaceTypeFieldResolver;
    protected final function getUserTypeAPI() : UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
    }
    protected final function getEmailScalarTypeResolver() : EmailScalarTypeResolver
    {
        if ($this->emailScalarTypeResolver === null) {
            /** @var EmailScalarTypeResolver */
            $emailScalarTypeResolver = $this->instanceManager->getInstance(EmailScalarTypeResolver::class);
            $this->emailScalarTypeResolver = $emailScalarTypeResolver;
        }
        return $this->emailScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getURLScalarTypeResolver() : URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
    }
    protected final function getQueryableInterfaceTypeFieldResolver() : QueryableInterfaceTypeFieldResolver
    {
        if ($this->queryableInterfaceTypeFieldResolver === null) {
            /** @var QueryableInterfaceTypeFieldResolver */
            $queryableInterfaceTypeFieldResolver = $this->instanceManager->getInstance(QueryableInterfaceTypeFieldResolver::class);
            $this->queryableInterfaceTypeFieldResolver = $queryableInterfaceTypeFieldResolver;
        }
        return $this->queryableInterfaceTypeFieldResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [UserObjectTypeResolver::class];
    }
    /**
     * @return array<InterfaceTypeFieldResolverInterface>
     */
    public function getImplementedInterfaceTypeFieldResolvers() : array
    {
        return [$this->getQueryableInterfaceTypeFieldResolver()];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['url', 'urlPath', 'slug', 'username', 'name', 'displayName', 'firstName', 'lastName', 'email', 'description', 'websiteURL'];
    }
    /**
     * @return string[]
     */
    public function getSensitiveFieldNames() : array
    {
        $sensitiveFieldNames = parent::getSensitiveFieldNames();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->treatUserEmailAsSensitiveData()) {
            $sensitiveFieldNames[] = 'email';
        }
        return $sensitiveFieldNames;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'username':
                return $this->getStringScalarTypeResolver();
            case 'name':
                return $this->getStringScalarTypeResolver();
            case 'displayName':
                return $this->getStringScalarTypeResolver();
            case 'firstName':
                return $this->getStringScalarTypeResolver();
            case 'lastName':
                return $this->getStringScalarTypeResolver();
            case 'email':
                return $this->getEmailScalarTypeResolver();
            case 'description':
                return $this->getStringScalarTypeResolver();
            case 'websiteURL':
                return $this->getURLScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'username':
            case 'name':
            case 'displayName':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'url':
                return $this->__('URL of the user\'s profile in the website', 'pop-users');
            case 'urlPath':
                return $this->__('URL path of the user\'s profile in the website', 'pop-users');
            case 'slug':
                return $this->__('Slug of the URL of the user\'s profile in the website', 'pop-users');
            case 'username':
                return $this->__('User\'s username handle', 'pop-users');
            case 'name':
                return $this->__('Name of the user', 'pop-users');
            case 'displayName':
                return $this->__('Name of the user as displayed on the website', 'pop-users');
            case 'firstName':
                return $this->__('User\'s first name', 'pop-users');
            case 'lastName':
                return $this->__('User\'s last name', 'pop-users');
            case 'email':
                return $this->__('User\'s email', 'pop-users');
            case 'description':
                return $this->__('Description of the user', 'pop-users');
            case 'websiteURL':
                return $this->__('User\'s own website\'s URL', 'pop-users');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $user = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'username':
                return $this->getUserTypeAPI()->getUserLogin($user);
            case 'name':
            case 'displayName':
                return $this->getUserTypeAPI()->getUserDisplayName($user);
            case 'firstName':
                return $this->getUserTypeAPI()->getUserFirstname($user);
            case 'lastName':
                return $this->getUserTypeAPI()->getUserLastname($user);
            case 'email':
                return $this->getUserTypeAPI()->getUserEmail($user);
            case 'url':
                return $this->getUserTypeAPI()->getUserURL($user);
            case 'urlPath':
                /** @var string */
                return $this->getUserTypeAPI()->getUserURLPath($user);
            case 'slug':
                return $this->getUserTypeAPI()->getUserSlug($user);
            case 'description':
                return $this->getUserTypeAPI()->getUserDescription($user);
            case 'websiteURL':
                return $this->getUserTypeAPI()->getUserWebsiteURL($user);
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
