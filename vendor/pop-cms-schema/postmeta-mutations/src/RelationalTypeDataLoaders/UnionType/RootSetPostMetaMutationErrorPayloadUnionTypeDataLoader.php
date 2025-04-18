<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootSetPostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetPostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootSetPostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetPostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetPostMetaMutationErrorPayloadUnionTypeResolver() : RootSetPostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetPostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetPostMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetPostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetPostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetPostMetaMutationErrorPayloadUnionTypeResolver = $rootSetPostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetPostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetPostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
