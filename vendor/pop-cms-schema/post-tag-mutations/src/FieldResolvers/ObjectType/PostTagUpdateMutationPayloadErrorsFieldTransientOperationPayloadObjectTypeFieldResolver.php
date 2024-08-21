<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostTagUpdateMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostTagUpdateMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $postTagUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setPostTagUpdateMutationErrorPayloadUnionTypeResolver(PostTagUpdateMutationErrorPayloadUnionTypeResolver $postTagUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postTagUpdateMutationErrorPayloadUnionTypeResolver = $postTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostTagUpdateMutationErrorPayloadUnionTypeResolver() : PostTagUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagUpdateMutationErrorPayloadUnionTypeResolver */
            $postTagUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagUpdateMutationErrorPayloadUnionTypeResolver = $postTagUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostTagUpdateMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostTagUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
