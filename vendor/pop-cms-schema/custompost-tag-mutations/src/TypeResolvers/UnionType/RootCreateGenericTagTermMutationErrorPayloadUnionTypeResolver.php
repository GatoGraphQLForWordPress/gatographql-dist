<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractRootCreateTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver extends AbstractRootCreateTagTermMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader() : RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateGenericTagTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader();
    }
}