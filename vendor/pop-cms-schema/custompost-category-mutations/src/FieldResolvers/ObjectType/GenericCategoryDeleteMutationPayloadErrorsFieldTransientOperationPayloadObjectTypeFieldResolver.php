<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCategoryDeleteMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
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
