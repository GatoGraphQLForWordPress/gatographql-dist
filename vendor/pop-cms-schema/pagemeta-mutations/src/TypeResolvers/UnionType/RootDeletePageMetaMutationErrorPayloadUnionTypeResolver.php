<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeletePageMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader() : RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader = $rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeletePageMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a page', 'page-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
