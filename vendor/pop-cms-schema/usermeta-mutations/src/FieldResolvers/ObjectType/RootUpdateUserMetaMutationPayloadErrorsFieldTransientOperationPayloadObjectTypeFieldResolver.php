<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootUpdateUserMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootUpdateUserMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateUserMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootUpdateUserMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootUpdateUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
