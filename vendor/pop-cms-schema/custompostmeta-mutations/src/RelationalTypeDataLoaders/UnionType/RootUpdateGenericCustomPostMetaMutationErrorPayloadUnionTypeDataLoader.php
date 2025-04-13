<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
