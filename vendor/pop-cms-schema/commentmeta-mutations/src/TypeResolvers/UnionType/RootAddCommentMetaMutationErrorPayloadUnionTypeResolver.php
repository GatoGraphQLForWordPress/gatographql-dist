<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\AbstractRootAddCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootAddCommentMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootAddCommentMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader() : RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader = $rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootAddCommentMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a comment', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
