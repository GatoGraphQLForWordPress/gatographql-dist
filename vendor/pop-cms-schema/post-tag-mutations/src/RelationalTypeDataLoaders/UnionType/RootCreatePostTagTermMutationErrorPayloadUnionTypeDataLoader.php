<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootCreatePostTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreatePostTagTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootCreatePostTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver;
    protected final function getRootCreatePostTagTermMutationErrorPayloadUnionTypeResolver() : RootCreatePostTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreatePostTagTermMutationErrorPayloadUnionTypeResolver */
            $rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreatePostTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver = $rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreatePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreatePostTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
