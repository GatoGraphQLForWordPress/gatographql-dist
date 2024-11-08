<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoPCMSSchema\Comments\RelationalTypeDataLoaders\ObjectType\CommentObjectTypeDataLoader;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
/** @internal */
class CommentObjectTypeResolver extends AbstractObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
    /**
     * @var \PoPCMSSchema\Comments\RelationalTypeDataLoaders\ObjectType\CommentObjectTypeDataLoader|null
     */
    private $commentObjectTypeDataLoader;
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
    }
    protected final function getCommentObjectTypeDataLoader() : CommentObjectTypeDataLoader
    {
        if ($this->commentObjectTypeDataLoader === null) {
            /** @var CommentObjectTypeDataLoader */
            $commentObjectTypeDataLoader = $this->instanceManager->getInstance(CommentObjectTypeDataLoader::class);
            $this->commentObjectTypeDataLoader = $commentObjectTypeDataLoader;
        }
        return $this->commentObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'Comment';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Comments added to custom posts', 'comments');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        $comment = $object;
        return $this->getCommentTypeAPI()->getCommentID($comment);
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCommentObjectTypeDataLoader();
    }
}
