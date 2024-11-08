<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostSetTagsMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver() : GenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver = $genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostSetTagsMutationErrorPayloadUnionTypeResolver();
    }
}
