<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver extends AbstractCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader() : GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader */
            $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader = $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericCustomPostDeleteMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a custom post (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
