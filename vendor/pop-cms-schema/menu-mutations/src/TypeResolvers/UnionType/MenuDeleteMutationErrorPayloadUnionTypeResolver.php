<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\UnionType\MenuDeleteMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class MenuDeleteMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\AbstractDeleteMenuMutationErrorPayloadUnionTypeResolver
{
    private ?MenuDeleteMutationErrorPayloadUnionTypeDataLoader $menuDeleteMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getMenuDeleteMutationErrorPayloadUnionTypeDataLoader() : MenuDeleteMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->menuDeleteMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var MenuDeleteMutationErrorPayloadUnionTypeDataLoader */
            $menuDeleteMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(MenuDeleteMutationErrorPayloadUnionTypeDataLoader::class);
            $this->menuDeleteMutationErrorPayloadUnionTypeDataLoader = $menuDeleteMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->menuDeleteMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'MenuDeleteMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a menu (nested mutations)', 'gatographql');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getMenuDeleteMutationErrorPayloadUnionTypeDataLoader();
    }
}
