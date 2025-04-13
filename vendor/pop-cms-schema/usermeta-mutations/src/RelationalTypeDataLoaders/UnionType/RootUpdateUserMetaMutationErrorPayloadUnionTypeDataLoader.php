<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateUserMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateUserMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
