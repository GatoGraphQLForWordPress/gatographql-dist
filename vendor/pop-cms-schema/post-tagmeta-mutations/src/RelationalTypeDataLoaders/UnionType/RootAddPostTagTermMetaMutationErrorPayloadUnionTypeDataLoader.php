<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootAddPostTagTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
