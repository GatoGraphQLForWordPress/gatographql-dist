<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver() : RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetPostCategoryTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
