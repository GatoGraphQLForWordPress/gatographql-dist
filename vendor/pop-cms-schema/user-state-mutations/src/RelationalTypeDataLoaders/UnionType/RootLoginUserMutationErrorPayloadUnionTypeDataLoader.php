<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\RootLoginUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootLoginUserMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\RootLoginUserMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootLoginUserMutationErrorPayloadUnionTypeResolver;
    public final function setRootLoginUserMutationErrorPayloadUnionTypeResolver(RootLoginUserMutationErrorPayloadUnionTypeResolver $rootLoginUserMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootLoginUserMutationErrorPayloadUnionTypeResolver = $rootLoginUserMutationErrorPayloadUnionTypeResolver;
    }
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
