<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagUpdateMutationErrorPayloadUnionTypeResolver;
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
