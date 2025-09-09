<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\UnionType\AbstractRootSetCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootSetCategoryTermMetaMutationErrorPayloadUnionTypeResolver
{
    private ?RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader() : RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader = $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetGenericCategoryTermMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting meta on a category term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
