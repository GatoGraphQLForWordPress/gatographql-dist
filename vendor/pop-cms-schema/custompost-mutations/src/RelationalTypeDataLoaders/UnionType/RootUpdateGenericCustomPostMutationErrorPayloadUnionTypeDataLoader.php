<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver(RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver $rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateGenericCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
