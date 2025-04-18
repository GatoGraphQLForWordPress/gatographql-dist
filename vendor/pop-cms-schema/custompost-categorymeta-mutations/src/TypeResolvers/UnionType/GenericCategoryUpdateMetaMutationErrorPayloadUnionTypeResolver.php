<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\UnionType\AbstractCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver extends AbstractCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType\GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getGenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader() : GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader */
            $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader = $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating meta on a category term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
