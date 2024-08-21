<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver(RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver();
    }
}