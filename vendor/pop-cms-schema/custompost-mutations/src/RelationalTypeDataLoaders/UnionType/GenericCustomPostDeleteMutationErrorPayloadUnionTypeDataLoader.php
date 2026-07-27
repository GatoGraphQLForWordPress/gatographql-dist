<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\GenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver $genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver() : GenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver = $genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
