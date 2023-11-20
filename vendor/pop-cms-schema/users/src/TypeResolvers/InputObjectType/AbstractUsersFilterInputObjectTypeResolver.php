<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\AbstractObjectsFilterInputObjectTypeResolver;
/** @internal */
abstract class AbstractUsersFilterInputObjectTypeResolver extends AbstractObjectsFilterInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\InputObjectType\UserSearchByOneofInputObjectTypeResolver|null
     */
    private $userSearchByOneofInputObjectTypeResolver;
    public final function setUserSearchByOneofInputObjectTypeResolver(\PoPCMSSchema\Users\TypeResolvers\InputObjectType\UserSearchByOneofInputObjectTypeResolver $userSearchByOneofInputObjectTypeResolver) : void
    {
        $this->userSearchByOneofInputObjectTypeResolver = $userSearchByOneofInputObjectTypeResolver;
    }
    protected final function getUserSearchByOneofInputObjectTypeResolver() : \PoPCMSSchema\Users\TypeResolvers\InputObjectType\UserSearchByOneofInputObjectTypeResolver
    {
        if ($this->userSearchByOneofInputObjectTypeResolver === null) {
            /** @var UserSearchByOneofInputObjectTypeResolver */
            $userSearchByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\Users\TypeResolvers\InputObjectType\UserSearchByOneofInputObjectTypeResolver::class);
            $this->userSearchByOneofInputObjectTypeResolver = $userSearchByOneofInputObjectTypeResolver;
        }
        return $this->userSearchByOneofInputObjectTypeResolver;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to filter users', 'users');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['searchBy' => $this->getUserSearchByOneofInputObjectTypeResolver()]);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'searchBy':
                return $this->__('Search for users', 'users');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
