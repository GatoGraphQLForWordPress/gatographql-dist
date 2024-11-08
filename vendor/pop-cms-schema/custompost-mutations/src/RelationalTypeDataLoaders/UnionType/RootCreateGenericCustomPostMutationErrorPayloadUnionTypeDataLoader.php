<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    protected final function getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver() : RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
