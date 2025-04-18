<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePostTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
