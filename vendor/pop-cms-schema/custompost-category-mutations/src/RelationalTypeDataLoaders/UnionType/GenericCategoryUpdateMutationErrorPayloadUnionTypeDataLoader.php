<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCategoryUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCategoryUpdateMutationErrorPayloadUnionTypeResolver(GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver $genericCategoryUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCategoryUpdateMutationErrorPayloadUnionTypeResolver = $genericCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCategoryUpdateMutationErrorPayloadUnionTypeResolver() : GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCategoryUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver */
            $genericCategoryUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCategoryUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCategoryUpdateMutationErrorPayloadUnionTypeResolver = $genericCategoryUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCategoryUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
