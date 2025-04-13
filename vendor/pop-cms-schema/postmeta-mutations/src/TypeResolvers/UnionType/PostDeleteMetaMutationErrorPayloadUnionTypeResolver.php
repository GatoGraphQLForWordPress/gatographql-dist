<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostDeleteMetaMutationErrorPayloadUnionTypeResolver extends AbstractCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader() : PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postDeleteMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader */
            $postDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $postDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostDeleteMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a post (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
