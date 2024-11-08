<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractRootUpdateTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver extends AbstractRootUpdateTagTermMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader() : RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdateGenericTagTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdateGenericTagTermMutationErrorPayloadUnionTypeDataLoader();
    }
}
