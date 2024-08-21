<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractCategoryUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver extends AbstractCategoryUpdateMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType\GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader;
    public final function setGenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader(GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader $genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader = $genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getGenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader() : GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader */
            $genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader = $genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a category term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader();
    }
}
