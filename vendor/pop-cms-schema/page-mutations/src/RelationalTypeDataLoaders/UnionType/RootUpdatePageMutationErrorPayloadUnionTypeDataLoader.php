<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\RootUpdatePageMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePageMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\UnionType\RootUpdatePageMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePageMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePageMutationErrorPayloadUnionTypeResolver() : RootUpdatePageMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePageMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePageMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePageMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePageMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePageMutationErrorPayloadUnionTypeResolver = $rootUpdatePageMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePageMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePageMutationErrorPayloadUnionTypeResolver();
    }
}
