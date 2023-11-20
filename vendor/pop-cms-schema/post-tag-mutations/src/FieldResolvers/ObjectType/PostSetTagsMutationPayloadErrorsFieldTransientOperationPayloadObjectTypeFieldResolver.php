<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostSetTagsMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostSetTagsMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostSetTagsMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostSetTagsMutationErrorPayloadUnionTypeResolver|null
     */
    private $postSetTagsMutationErrorPayloadUnionTypeResolver;
    public final function setPostSetTagsMutationErrorPayloadUnionTypeResolver(PostSetTagsMutationErrorPayloadUnionTypeResolver $postSetTagsMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postSetTagsMutationErrorPayloadUnionTypeResolver = $postSetTagsMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostSetTagsMutationErrorPayloadUnionTypeResolver() : PostSetTagsMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postSetTagsMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostSetTagsMutationErrorPayloadUnionTypeResolver */
            $postSetTagsMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostSetTagsMutationErrorPayloadUnionTypeResolver::class);
            $this->postSetTagsMutationErrorPayloadUnionTypeResolver = $postSetTagsMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postSetTagsMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostSetTagsMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostSetTagsMutationErrorPayloadUnionTypeResolver();
    }
}
