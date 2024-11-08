<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\AbstractGenericCategoriesMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType\GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
    protected final function getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader() : GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader */
            $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader = $genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericCustomPostSetCategoriesMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting categories on a custom post (using nested mutations)', 'postcategory-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericCustomPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader();
    }
}
