<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractRootUpdateCategoryMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver extends AbstractRootUpdateCategoryMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    public final function setRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader(RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader() : RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader = $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdateGenericCategoryTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a category term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader();
    }
}
