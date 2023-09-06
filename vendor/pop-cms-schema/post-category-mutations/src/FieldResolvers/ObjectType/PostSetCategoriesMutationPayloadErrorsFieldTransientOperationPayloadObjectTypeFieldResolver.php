<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostSetCategoriesMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
class PostSetCategoriesMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeResolver|null
     */
    private $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    public final function setPostSetCategoriesMutationErrorPayloadUnionTypeResolver(PostSetCategoriesMutationErrorPayloadUnionTypeResolver $postSetCategoriesMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver = $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostSetCategoriesMutationErrorPayloadUnionTypeResolver() : PostSetCategoriesMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postSetCategoriesMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostSetCategoriesMutationErrorPayloadUnionTypeResolver */
            $postSetCategoriesMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostSetCategoriesMutationErrorPayloadUnionTypeResolver::class);
            $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver = $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostSetCategoriesMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostSetCategoriesMutationErrorPayloadUnionTypeResolver();
    }
}
