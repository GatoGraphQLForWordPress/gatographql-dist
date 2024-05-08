<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCustomPostUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
    public final function setGenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver(GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver $genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver = $genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getGenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver() : GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver = $genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCustomPostUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
