<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootUpdateCommentMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootUpdateCommentMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootUpdateCommentMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver();
    }
}
