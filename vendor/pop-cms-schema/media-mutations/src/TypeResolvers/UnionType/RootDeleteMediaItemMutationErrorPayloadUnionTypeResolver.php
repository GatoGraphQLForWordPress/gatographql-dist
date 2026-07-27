<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType\RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractDeleteMediaItemMutationErrorPayloadUnionTypeResolver
{
    private ?RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader $rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader() : RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader */
            $rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader = $rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteMediaItemMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting an attachment', 'gatographql');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader();
    }
}
