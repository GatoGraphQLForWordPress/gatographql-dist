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
    /**
     * @param string|int $entityID
     */
    protected function doesMetaEntryExist($entityID, string $key) : bool
    {
        return $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \true) !== null;
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryWithValueExist($entityID, string $key, $value) : bool
    {
        return \in_array($value, $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \false));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryHaveValue($entityID, string $key, $value) : bool
    {
        $existingValue = $this->getCommentMetaTypeAPI()->getCommentMeta($entityID, $key, \false);
        return $existingValue === [$value];
    }
}
