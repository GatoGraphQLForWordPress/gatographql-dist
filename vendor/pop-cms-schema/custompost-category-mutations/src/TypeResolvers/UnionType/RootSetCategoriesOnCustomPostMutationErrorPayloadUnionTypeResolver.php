<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType\RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\AbstractGenericCategoriesMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType\RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader() : RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader */
            $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader = $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetCategoriesOnCustomPostMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting categories on a custom post', 'postcategory-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader();
    }
}
