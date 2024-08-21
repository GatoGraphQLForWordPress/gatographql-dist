<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractTagDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericTagDeleteMutationErrorPayloadUnionTypeResolver extends AbstractTagDeleteMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericTagDeleteMutationErrorPayloadUnionTypeDataLoader;
    public final function setGenericTagDeleteMutationErrorPayloadUnionTypeDataLoader(GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader $genericTagDeleteMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->genericTagDeleteMutationErrorPayloadUnionTypeDataLoader = $genericTagDeleteMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getGenericTagDeleteMutationErrorPayloadUnionTypeDataLoader() : GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericTagDeleteMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader */
            $genericTagDeleteMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericTagDeleteMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericTagDeleteMutationErrorPayloadUnionTypeDataLoader = $genericTagDeleteMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericTagDeleteMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericTagDeleteMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a tag term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericTagDeleteMutationErrorPayloadUnionTypeDataLoader();
    }
}
