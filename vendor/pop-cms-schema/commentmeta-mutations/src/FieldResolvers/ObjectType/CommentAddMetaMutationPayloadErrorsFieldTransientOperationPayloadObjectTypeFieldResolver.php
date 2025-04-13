<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentAddMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class CommentAddMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $commentAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getCommentAddMetaMutationErrorPayloadUnionTypeResolver() : CommentAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentAddMetaMutationErrorPayloadUnionTypeResolver */
            $commentAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->commentAddMetaMutationErrorPayloadUnionTypeResolver = $commentAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [CommentAddMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getCommentAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
