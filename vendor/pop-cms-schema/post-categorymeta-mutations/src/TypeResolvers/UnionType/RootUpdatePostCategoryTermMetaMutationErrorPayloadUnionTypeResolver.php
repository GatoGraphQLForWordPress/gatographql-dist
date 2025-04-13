<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\UnionType\AbstractRootUpdateCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootUpdateCategoryTermMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader() : RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader = $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdatePostCategoryTermMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating meta on a post\'s category term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
