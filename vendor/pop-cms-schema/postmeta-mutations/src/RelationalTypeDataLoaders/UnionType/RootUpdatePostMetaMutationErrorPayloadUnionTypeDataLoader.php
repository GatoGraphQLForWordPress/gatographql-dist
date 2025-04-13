<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootUpdatePostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\RootUpdatePostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePostMetaMutationErrorPayloadUnionTypeResolver() : RootUpdatePostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver = $rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
