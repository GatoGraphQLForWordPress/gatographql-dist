<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType\PostUpdateMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostUpdateMutationErrorPayloadUnionTypeResolver extends AbstractCustomPostUpdateMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType\PostUpdateMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postUpdateMutationErrorPayloadUnionTypeDataLoader;
    public final function setPostUpdateMutationErrorPayloadUnionTypeDataLoader(PostUpdateMutationErrorPayloadUnionTypeDataLoader $postUpdateMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->postUpdateMutationErrorPayloadUnionTypeDataLoader = $postUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getPostUpdateMutationErrorPayloadUnionTypeDataLoader() : PostUpdateMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postUpdateMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostUpdateMutationErrorPayloadUnionTypeDataLoader */
            $postUpdateMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostUpdateMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postUpdateMutationErrorPayloadUnionTypeDataLoader = $postUpdateMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostUpdateMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a post (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostUpdateMutationErrorPayloadUnionTypeDataLoader();
    }
}
