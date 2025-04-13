<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeAPIs;

use PoPCMSSchema\CommentMetaMutations\Exception\CommentMetaCRUDMutationException;
use PoPCMSSchema\CommentMetaMutations\TypeAPIs\CommentMetaTypeMutationAPIInterface;
use PoPCMSSchema\MetaMutations\TypeAPIs\AbstractEntityMetaTypeMutationAPI;
/** @internal */
abstract class AbstractCommentMetaTypeMutationAPI extends AbstractEntityMetaTypeMutationAPI implements CommentMetaTypeMutationAPIInterface
{
    /**
     * @phpstan-return class-string<CommentMetaCRUDMutationException>
     */
    protected function getEntityMetaCRUDMutationExceptionClass() : string
    {
        return CommentMetaCRUDMutationException::class;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CommentMetaCRUDMutationException If there was an error
     * @param string|int $commentID
     */
    public function setCommentMeta($commentID, array $entries) : void
    {
        $this->setEntityMeta($commentID, $entries);
    }
    /**
     * @return int The term_id of the newly created term
     * @throws CommentMetaCRUDMutationException If there was an error
     * @param string|int $commentID
     * @param mixed $value
     */
    public function addCommentMeta($commentID, string $key, $value, bool $single = \false) : int
    {
        return $this->addEntityMeta($commentID, $key, $value, $single);
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     * @param string|int $commentID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateCommentMeta($commentID, string $key, $value, $prevValue = null)
    {
        return $this->updateEntityMeta($commentID, $key, $value, $prevValue);
    }
    /**
     * @throws CommentMetaCRUDMutationException If there was an error (eg: comment does not exist)
     * @param string|int $commentID
     * @param mixed $value
     */
    public function deleteCommentMeta($commentID, string $key, $value = null) : void
    {
        $this->deleteEntityMeta($commentID, $key, $value);
    }
}
