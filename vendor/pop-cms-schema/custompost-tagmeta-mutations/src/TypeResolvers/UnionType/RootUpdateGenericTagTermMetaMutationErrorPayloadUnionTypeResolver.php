<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractRootUpdateTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootUpdateTagTermMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader() : RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdateGenericTagTermMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating meta on a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdateGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
