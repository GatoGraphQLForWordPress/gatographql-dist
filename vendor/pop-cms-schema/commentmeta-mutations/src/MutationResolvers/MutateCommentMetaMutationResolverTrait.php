<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\MutationResolvers\MutateEntityMetaMutationResolverTrait;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface;
/** @internal */
trait MutateCommentMetaMutationResolverTrait
{
    use MutateEntityMetaMutationResolverTrait;
    protected abstract function getCommentMetaTypeAPI() : CommentMetaTypeAPIInterface;
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getCommentMetaTypeAPI();
    }
    protected function doesMetaEntryExist(string|int $entityID, string $key) : bool
    {
        return $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \true) !== null;
    }
    protected function doesMetaEntryWithValueExist(string|int $entityID, string $key, mixed $value) : bool
    {
        return \in_array($value, $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \false));
    }
    protected function doesMetaEntryHaveValue(string|int $entityID, string $key, mixed $value) : bool
    {
        $existingValue = $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \false);
        return $existingValue === [$value];
    }
}
