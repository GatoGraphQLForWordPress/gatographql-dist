<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver extends AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader() : RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateCustomPostMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a custom post', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeDataLoader();
    }
}
