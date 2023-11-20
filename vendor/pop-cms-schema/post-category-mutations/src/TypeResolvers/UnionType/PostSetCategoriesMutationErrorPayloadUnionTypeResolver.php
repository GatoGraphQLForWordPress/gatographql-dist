<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostSetCategoriesMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\AbstractPostCategoriesMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
    public final function setPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader(PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader $postSetCategoriesMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->postSetCategoriesMutationErrorPayloadUnionTypeDataLoader = $postSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader() : PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postSetCategoriesMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader */
            $postSetCategoriesMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postSetCategoriesMutationErrorPayloadUnionTypeDataLoader = $postSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postSetCategoriesMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostSetCategoriesMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting categories on a custom post (using nested mutations)', 'postcategory-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostSetCategoriesMutationErrorPayloadUnionTypeDataLoader();
    }
}
