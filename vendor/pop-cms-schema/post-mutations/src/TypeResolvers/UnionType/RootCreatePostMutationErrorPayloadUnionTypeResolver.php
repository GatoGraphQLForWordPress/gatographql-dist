<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType\RootCreatePostMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreatePostMutationErrorPayloadUnionTypeResolver extends AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType\RootCreatePostMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreatePostMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootCreatePostMutationErrorPayloadUnionTypeDataLoader() : RootCreatePostMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreatePostMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreatePostMutationErrorPayloadUnionTypeDataLoader */
            $rootCreatePostMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreatePostMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreatePostMutationErrorPayloadUnionTypeDataLoader = $rootCreatePostMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreatePostMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreatePostMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a post', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreatePostMutationErrorPayloadUnionTypeDataLoader();
    }
}
