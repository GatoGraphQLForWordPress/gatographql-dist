<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeleteGenericTagTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver(RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver() : RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver */
            $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
