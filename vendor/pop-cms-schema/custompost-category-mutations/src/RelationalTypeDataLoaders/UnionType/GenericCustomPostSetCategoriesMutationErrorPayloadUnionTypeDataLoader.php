<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver(GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver() : GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver();
    }
}
