<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType\RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader;
use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractRootDeleteTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteTagTermMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType\RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader;
    public final function setRootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader(RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader $rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader = $rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getRootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader() : RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader */
            $rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader = $rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeletePostTagTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a post tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader();
    }
}
