<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\RootLoginUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootLoginUserMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootLoginUserMutationErrorPayloadUnionTypeResolver $rootLoginUserMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootLoginUserMutationErrorPayloadUnionTypeResolver() : RootLoginUserMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootLoginUserMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootLoginUserMutationErrorPayloadUnionTypeResolver */
            $rootLoginUserMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootLoginUserMutationErrorPayloadUnionTypeResolver::class);
            $this->rootLoginUserMutationErrorPayloadUnionTypeResolver = $rootLoginUserMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootLoginUserMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootLoginUserMutationErrorPayloadUnionTypeResolver();
    }
}
