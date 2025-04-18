<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver extends AbstractTagDeleteMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getGenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader() : GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader */
            $genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericTagDeleteMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a tag term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
