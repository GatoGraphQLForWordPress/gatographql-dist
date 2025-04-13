<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeletePostMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader() : RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader = $rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeletePostMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a post', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
