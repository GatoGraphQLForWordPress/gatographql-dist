<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryDeleteMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostCategoryDeleteMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver() : PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver = $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryDeleteMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
