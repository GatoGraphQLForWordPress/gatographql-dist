<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootAddCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootAddPageMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootAddCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootAddPageMetaMutationErrorPayloadUnionTypeDataLoader() : RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader = $rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootAddPageMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootAddPageMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a page', 'page-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootAddPageMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
