<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PageSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $pageSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPageSetMetaMutationErrorPayloadUnionTypeResolver() : PageSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->pageSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PageSetMetaMutationErrorPayloadUnionTypeResolver */
            $pageSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PageSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->pageSetMetaMutationErrorPayloadUnionTypeResolver = $pageSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->pageSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPageSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
