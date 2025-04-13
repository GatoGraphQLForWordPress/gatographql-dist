<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootDeletePostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeletePostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootDeletePostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeletePostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootDeletePostMetaMutationErrorPayloadUnionTypeResolver() : RootDeletePostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostMetaMutationErrorPayloadUnionTypeResolver = $rootDeletePostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeletePostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
