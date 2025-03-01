<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver|null
     */
    private $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver;
    protected final function getCustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver() : CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver
    {
        if ($this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver */
            $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver::class);
            $this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver = $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver;
        }
        return $this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver();
    }
}
