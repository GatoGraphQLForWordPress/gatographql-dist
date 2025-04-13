<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractRootSetTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootSetTagTermMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader() : RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader = $rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetGenericTagTermMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting meta on a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetGenericTagTermMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
