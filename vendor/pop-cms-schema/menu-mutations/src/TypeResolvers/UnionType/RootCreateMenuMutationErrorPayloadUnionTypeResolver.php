<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\UnionType\RootCreateMenuMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateMenuMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\AbstractCreateMenuMutationErrorPayloadUnionTypeResolver
{
    private ?RootCreateMenuMutationErrorPayloadUnionTypeDataLoader $rootCreateMenuMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootCreateMenuMutationErrorPayloadUnionTypeDataLoader() : RootCreateMenuMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateMenuMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateMenuMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateMenuMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateMenuMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateMenuMutationErrorPayloadUnionTypeDataLoader = $rootCreateMenuMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateMenuMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateMenuMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a menu', 'menu-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateMenuMutationErrorPayloadUnionTypeDataLoader();
    }
}
