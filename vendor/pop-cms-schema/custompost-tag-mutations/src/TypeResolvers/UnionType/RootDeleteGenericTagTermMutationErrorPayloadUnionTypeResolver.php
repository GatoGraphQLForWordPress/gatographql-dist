<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractRootDeleteTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteTagTermMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader() : RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader */
            $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteGenericTagTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader();
    }
}