<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostCategoryUpdateMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostCategoryUpdateMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setPostCategoryUpdateMutationErrorPayloadUnionTypeResolver(PostCategoryUpdateMutationErrorPayloadUnionTypeResolver $postCategoryUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver = $postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostCategoryUpdateMutationErrorPayloadUnionTypeResolver() : PostCategoryUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryUpdateMutationErrorPayloadUnionTypeResolver */
            $postCategoryUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver = $postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryUpdateMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostCategoryUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
