<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagDeleteMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTagDeleteMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    public final function setGenericTagDeleteMutationErrorPayloadUnionTypeResolver(GenericTagDeleteMutationErrorPayloadUnionTypeResolver $genericTagDeleteMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver = $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericTagDeleteMutationErrorPayloadUnionTypeResolver() : GenericTagDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagDeleteMutationErrorPayloadUnionTypeResolver */
            $genericTagDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver = $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagDeleteMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericTagDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
