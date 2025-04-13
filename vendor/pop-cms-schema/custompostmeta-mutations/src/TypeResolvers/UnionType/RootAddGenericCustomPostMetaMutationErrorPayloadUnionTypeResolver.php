<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\AbstractRootAddCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootAddCustomPostMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader() : RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader = $rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootAddGenericCustomPostMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a custom post', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootAddGenericCustomPostMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
