<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\UnionType\RootUpdateMenuMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdateMenuMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\AbstractUpdateMenuMutationErrorPayloadUnionTypeResolver
{
    private ?RootUpdateMenuMutationErrorPayloadUnionTypeDataLoader $rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootUpdateMenuMutationErrorPayloadUnionTypeDataLoader() : RootUpdateMenuMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdateMenuMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdateMenuMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader = $rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdateMenuMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdateMenuMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a menu', 'menu-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdateMenuMutationErrorPayloadUnionTypeDataLoader();
    }
}
