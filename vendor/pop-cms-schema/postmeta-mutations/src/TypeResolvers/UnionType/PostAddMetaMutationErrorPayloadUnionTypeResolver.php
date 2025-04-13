<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\PostAddMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostAddMetaMutationErrorPayloadUnionTypeResolver extends AbstractCustomPostAddMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\PostAddMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postAddMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getPostAddMetaMutationErrorPayloadUnionTypeDataLoader() : PostAddMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postAddMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostAddMetaMutationErrorPayloadUnionTypeDataLoader */
            $postAddMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostAddMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postAddMetaMutationErrorPayloadUnionTypeDataLoader = $postAddMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postAddMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostAddMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a post (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostAddMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
