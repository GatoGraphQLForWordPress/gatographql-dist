<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\SchemaHooks;

use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolverInterface;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\SchemaHooks\AbstractCommentMutationResolverHookSet;
/** @internal */
class CommentMutationResolverHookSet extends AbstractCommentMutationResolverHookSet
{
    use \PoPCMSSchema\CommentMetaMutations\SchemaHooks\CommentMutationResolverHookSetTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    protected function getCommentTypeResolver() : CommentObjectTypeResolverInterface
    {
        return $this->getCommentObjectTypeResolver();
    }
}
