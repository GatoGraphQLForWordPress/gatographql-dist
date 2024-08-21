<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagUpdateMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTagUpdateMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setGenericTagUpdateMutationErrorPayloadUnionTypeResolver(GenericTagUpdateMutationErrorPayloadUnionTypeResolver $genericTagUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver = $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericTagUpdateMutationErrorPayloadUnionTypeResolver() : GenericTagUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagUpdateMutationErrorPayloadUnionTypeResolver */
            $genericTagUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver = $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagUpdateMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericTagUpdateMutationErrorPayloadUnionTypeResolver();
    }
}