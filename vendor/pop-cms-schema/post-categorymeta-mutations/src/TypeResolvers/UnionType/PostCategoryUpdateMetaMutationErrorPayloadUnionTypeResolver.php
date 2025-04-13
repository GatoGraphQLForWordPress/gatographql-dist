<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\UnionType\AbstractCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver extends AbstractCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getPostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader() : PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader */
            $postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader = $postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'PostCategoryUpdateMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating meta on a post\'s category term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
