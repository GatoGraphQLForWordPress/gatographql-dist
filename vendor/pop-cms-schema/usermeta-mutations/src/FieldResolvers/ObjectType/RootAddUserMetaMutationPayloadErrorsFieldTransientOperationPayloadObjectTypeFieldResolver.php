<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootAddUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootAddUserMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootAddUserMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootAddUserMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootAddUserMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootAddUserMetaMutationErrorPayloadUnionTypeResolver() : RootAddUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver = $rootAddUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootAddUserMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootAddUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
