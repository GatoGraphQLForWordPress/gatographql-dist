<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
