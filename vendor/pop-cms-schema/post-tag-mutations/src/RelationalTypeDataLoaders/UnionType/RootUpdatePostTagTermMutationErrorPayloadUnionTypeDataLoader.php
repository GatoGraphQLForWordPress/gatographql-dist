<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePostTagTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver() : RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
