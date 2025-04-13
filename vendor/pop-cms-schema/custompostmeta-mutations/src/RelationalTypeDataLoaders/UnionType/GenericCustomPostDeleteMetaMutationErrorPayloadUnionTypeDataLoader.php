<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
