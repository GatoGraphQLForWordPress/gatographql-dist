<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setGenericTagUpdateMutationErrorPayloadUnionTypeResolver(GenericTagUpdateMutationErrorPayloadUnionTypeResolver $genericTagUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver = $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericTagUpdateMutationErrorPayloadUnionTypeResolver() : GenericTagUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagUpdateMutationErrorPayloadUnionTypeResolver */
            $genericTagUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver = $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
