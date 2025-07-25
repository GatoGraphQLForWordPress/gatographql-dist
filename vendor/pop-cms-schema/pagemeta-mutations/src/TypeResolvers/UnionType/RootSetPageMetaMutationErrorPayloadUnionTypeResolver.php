<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootSetCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetPageMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootSetCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootSetPageMetaMutationErrorPayloadUnionTypeDataLoader() : RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader = $rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetPageMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetPageMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting meta on a page', 'page-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetPageMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
