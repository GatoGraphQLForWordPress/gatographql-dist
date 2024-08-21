<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostTagUpdateMutationErrorPayloadUnionTypeResolver extends AbstractTagUpdateMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    public final function setPostTagUpdateMutationErrorPayloadUnionTypeDataLoader(PostTagUpdateMutationErrorPayloadUnionTypeDataLoader $postTagUpdateMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->postTagUpdateMutationErrorPayloadUnionTypeDataLoader = $postTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getPostTagUpdateMutationErrorPayloadUnionTypeDataLoader() : PostTagUpdateMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postTagUpdateMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostTagUpdateMutationErrorPayloadUnionTypeDataLoader */
            $postTagUpdateMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostTagUpdateMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postTagUpdateMutationErrorPayloadUnionTypeDataLoader = $postTagUpdateMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostTagUpdateMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a post tag term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostTagUpdateMutationErrorPayloadUnionTypeDataLoader();
    }
}
