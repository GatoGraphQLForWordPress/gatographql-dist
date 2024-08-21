<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractRootUpdateCategoryMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver extends AbstractRootUpdateCategoryMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType\RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    public final function setRootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader(RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getRootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader() : RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdatePostCategoryTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a post category term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader();
    }
}