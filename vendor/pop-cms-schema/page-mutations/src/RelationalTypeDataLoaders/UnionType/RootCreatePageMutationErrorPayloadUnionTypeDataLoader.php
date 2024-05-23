<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\RootCreatePageMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreatePageMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\UnionType\RootCreatePageMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreatePageMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreatePageMutationErrorPayloadUnionTypeResolver(RootCreatePageMutationErrorPayloadUnionTypeResolver $rootCreatePageMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreatePageMutationErrorPayloadUnionTypeResolver = $rootCreatePageMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreatePageMutationErrorPayloadUnionTypeResolver() : RootCreatePageMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreatePageMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreatePageMutationErrorPayloadUnionTypeResolver */
            $rootCreatePageMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreatePageMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreatePageMutationErrorPayloadUnionTypeResolver = $rootCreatePageMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreatePageMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreatePageMutationErrorPayloadUnionTypeResolver();
    }
}
