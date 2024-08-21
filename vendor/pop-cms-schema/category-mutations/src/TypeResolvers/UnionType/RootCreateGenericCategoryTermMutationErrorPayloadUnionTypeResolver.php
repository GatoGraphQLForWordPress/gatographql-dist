<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractRootCreateCategoryMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver extends AbstractRootCreateCategoryMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    public final function setRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader() : RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateGenericCategoryTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a category term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader();
    }
}
