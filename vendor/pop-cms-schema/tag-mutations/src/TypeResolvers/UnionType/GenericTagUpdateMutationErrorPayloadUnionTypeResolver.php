<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericTagUpdateMutationErrorPayloadUnionTypeResolver extends AbstractTagUpdateMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    public final function setGenericTagUpdateMutationErrorPayloadUnionTypeDataLoader(GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader $genericTagUpdateMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->genericTagUpdateMutationErrorPayloadUnionTypeDataLoader = $genericTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getGenericTagUpdateMutationErrorPayloadUnionTypeDataLoader() : GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericTagUpdateMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader */
            $genericTagUpdateMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericTagUpdateMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericTagUpdateMutationErrorPayloadUnionTypeDataLoader = $genericTagUpdateMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericTagUpdateMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericTagUpdateMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating a tag term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericTagUpdateMutationErrorPayloadUnionTypeDataLoader();
    }
}
