<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryAddMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostCategoryAddMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryAddMetaMutationErrorPayloadUnionTypeResolver() : PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver */
            $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver = $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryAddMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostCategoryAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
