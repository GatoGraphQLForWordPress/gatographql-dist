<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCustomPostSetCategoriesMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostSetCategoriesMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver(GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver() : GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostSetCategoriesMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver();
    }
}
