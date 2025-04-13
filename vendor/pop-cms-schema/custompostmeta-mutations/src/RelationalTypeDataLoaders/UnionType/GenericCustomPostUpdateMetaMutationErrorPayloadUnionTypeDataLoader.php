<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
