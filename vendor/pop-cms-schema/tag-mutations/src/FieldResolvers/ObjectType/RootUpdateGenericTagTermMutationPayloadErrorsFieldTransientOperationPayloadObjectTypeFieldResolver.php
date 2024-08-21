<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootUpdateGenericTagTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver(RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootUpdateGenericTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
