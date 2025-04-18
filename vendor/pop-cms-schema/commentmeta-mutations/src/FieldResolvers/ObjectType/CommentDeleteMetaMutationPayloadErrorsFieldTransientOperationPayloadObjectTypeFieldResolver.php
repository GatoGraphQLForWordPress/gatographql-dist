<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentDeleteMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class CommentDeleteMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $commentDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getCommentDeleteMetaMutationErrorPayloadUnionTypeResolver() : CommentDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $commentDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver = $commentDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [CommentDeleteMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getCommentDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
