<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractRootAddTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootAddTagTermMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader() : RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootAddPostTagTermMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a post\'s tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
