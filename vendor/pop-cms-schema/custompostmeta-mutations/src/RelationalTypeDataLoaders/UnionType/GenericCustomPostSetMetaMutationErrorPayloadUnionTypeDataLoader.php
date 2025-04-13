<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
