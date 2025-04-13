<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
