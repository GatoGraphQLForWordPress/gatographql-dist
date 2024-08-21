<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCategoryDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver(GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver() : GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver */
            $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCategoryDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver = $genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCategoryDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
