<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    public final function setGenericTagDeleteMutationErrorPayloadUnionTypeResolver(GenericTagDeleteMutationErrorPayloadUnionTypeResolver $genericTagDeleteMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver = $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericTagDeleteMutationErrorPayloadUnionTypeResolver() : GenericTagDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagDeleteMutationErrorPayloadUnionTypeResolver */
            $genericTagDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver = $genericTagDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
