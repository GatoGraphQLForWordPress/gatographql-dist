<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\AbstractCommentMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractObjectMutationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
class CommentMutationPayloadObjectTypeFieldResolver extends AbstractObjectMutationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    public final function setCommentObjectTypeResolver(CommentObjectTypeResolver $commentObjectTypeResolver) : void
    {
        $this->commentObjectTypeResolver = $commentObjectTypeResolver;
    }
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCommentMutationPayloadObjectTypeResolver::class];
    }
    protected function getObjectFieldName() : string
    {
        return 'comment';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case $this->getObjectFieldName():
                return $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
