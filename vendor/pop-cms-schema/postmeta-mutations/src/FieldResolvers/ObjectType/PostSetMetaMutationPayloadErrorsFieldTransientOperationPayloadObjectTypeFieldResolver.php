<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostSetMetaMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostSetMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostSetMetaMutationErrorPayloadUnionTypeResolver() : PostSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostSetMetaMutationErrorPayloadUnionTypeResolver */
            $postSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postSetMetaMutationErrorPayloadUnionTypeResolver = $postSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostSetMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
