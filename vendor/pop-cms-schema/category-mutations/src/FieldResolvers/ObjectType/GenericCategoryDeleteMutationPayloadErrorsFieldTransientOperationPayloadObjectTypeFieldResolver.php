<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCategoryDeleteMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver(GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver() : GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver */
            $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCategoryDeleteMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
