<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootAddPostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootAddPostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootAddPostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootAddPostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootAddPostMetaMutationErrorPayloadUnionTypeResolver() : RootAddPostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddPostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddPostMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddPostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddPostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddPostMetaMutationErrorPayloadUnionTypeResolver = $rootAddPostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddPostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddPostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
