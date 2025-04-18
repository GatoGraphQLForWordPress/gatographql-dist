<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver() : RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
