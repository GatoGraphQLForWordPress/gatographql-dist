<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader() : RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader = $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCustomPostMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a custom post', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
