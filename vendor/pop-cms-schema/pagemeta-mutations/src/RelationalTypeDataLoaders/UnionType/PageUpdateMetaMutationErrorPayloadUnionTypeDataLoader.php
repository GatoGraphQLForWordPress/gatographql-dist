<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PageUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $pageUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPageUpdateMetaMutationErrorPayloadUnionTypeResolver() : PageUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->pageUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PageUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $pageUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PageUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->pageUpdateMetaMutationErrorPayloadUnionTypeResolver = $pageUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->pageUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPageUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
