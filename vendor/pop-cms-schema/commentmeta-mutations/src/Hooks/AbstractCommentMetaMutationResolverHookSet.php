<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\Hooks;

use PoPCMSSchema\CommentMetaMutations\MutationResolvers\MutateCommentMetaMutationResolverTrait;
use PoPCMSSchema\CommentMetaMutations\TypeAPIs\CommentMetaTypeMutationAPIInterface;
use PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface;
use PoPCMSSchema\CommentMutations\Constants\CommentCRUDHookNames;
use PoPCMSSchema\MetaMutations\Hooks\AbstractMetaMutationResolverHookSet;
use PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
/** @internal */
abstract class AbstractCommentMetaMutationResolverHookSet extends AbstractMetaMutationResolverHookSet
{
    use MutateCommentMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeAPIs\CommentMetaTypeMutationAPIInterface|null
     */
    private $commentMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface|null
     */
    private $commentMetaTypeAPI;
    protected final function getCommentMetaTypeMutationAPI() : CommentMetaTypeMutationAPIInterface
    {
        if ($this->commentMetaTypeMutationAPI === null) {
            /** @var CommentMetaTypeMutationAPIInterface */
            $commentMetaTypeMutationAPI = $this->instanceManager->getInstance(CommentMetaTypeMutationAPIInterface::class);
            $this->commentMetaTypeMutationAPI = $commentMetaTypeMutationAPI;
        }
        return $this->commentMetaTypeMutationAPI;
    }
    protected final function getCommentMetaTypeAPI() : CommentMetaTypeAPIInterface
    {
        if ($this->commentMetaTypeAPI === null) {
            /** @var CommentMetaTypeAPIInterface */
            $commentMetaTypeAPI = $this->instanceManager->getInstance(CommentMetaTypeAPIInterface::class);
            $this->commentMetaTypeAPI = $commentMetaTypeAPI;
        }
        return $this->commentMetaTypeAPI;
    }
    protected function getEntityMetaTypeMutationAPI() : EntityMetaTypeMutationAPIInterface
    {
        return $this->getCommentMetaTypeMutationAPI();
    }
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getCommentMetaTypeAPI();
    }
    protected function getErrorPayloadHookName() : string
    {
        return CommentCRUDHookNames::ERROR_PAYLOAD;
    }
}
