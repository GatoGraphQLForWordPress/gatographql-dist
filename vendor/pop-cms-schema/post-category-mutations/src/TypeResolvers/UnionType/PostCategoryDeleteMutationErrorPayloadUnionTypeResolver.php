<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostCategoryDeleteMutationErrorPayloadUnionTypeResolver extends AbstractCategoryDeleteMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader;
    protected final function getPostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader() : PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader */
            $postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader = $postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postCategoryDeleteMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostCategoryDeleteMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a post category term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader();
    }
}
