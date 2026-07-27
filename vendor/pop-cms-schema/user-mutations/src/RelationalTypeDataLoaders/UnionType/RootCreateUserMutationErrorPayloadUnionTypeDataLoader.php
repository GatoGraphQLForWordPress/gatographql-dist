<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\RootCreateUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreateUserMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootCreateUserMutationErrorPayloadUnionTypeResolver $rootCreateUserMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootCreateUserMutationErrorPayloadUnionTypeResolver() : RootCreateUserMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateUserMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateUserMutationErrorPayloadUnionTypeResolver */
            $rootCreateUserMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateUserMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateUserMutationErrorPayloadUnionTypeResolver = $rootCreateUserMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateUserMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreateUserMutationErrorPayloadUnionTypeResolver();
    }
}
