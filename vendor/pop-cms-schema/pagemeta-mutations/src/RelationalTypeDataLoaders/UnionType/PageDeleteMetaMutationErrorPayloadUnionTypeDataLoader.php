<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PageDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\PageDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $pageDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPageDeleteMetaMutationErrorPayloadUnionTypeResolver() : PageDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->pageDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PageDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $pageDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PageDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->pageDeleteMetaMutationErrorPayloadUnionTypeResolver = $pageDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->pageDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPageDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
