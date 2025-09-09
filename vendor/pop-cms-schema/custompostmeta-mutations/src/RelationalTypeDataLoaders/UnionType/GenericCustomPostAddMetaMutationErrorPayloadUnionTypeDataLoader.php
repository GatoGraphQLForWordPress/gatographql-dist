<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
