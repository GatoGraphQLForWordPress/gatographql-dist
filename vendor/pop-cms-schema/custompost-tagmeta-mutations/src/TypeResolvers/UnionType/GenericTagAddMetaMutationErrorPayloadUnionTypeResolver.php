<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractTagAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericTagAddMetaMutationErrorPayloadUnionTypeResolver extends AbstractTagAddMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType\GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getGenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader() : GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader */
            $genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader = $genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericTagAddMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericTagAddMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a tag term (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
