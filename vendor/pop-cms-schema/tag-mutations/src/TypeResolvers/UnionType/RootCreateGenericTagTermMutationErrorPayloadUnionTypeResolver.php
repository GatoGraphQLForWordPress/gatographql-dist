<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\UnionType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractRootCreateTagMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver extends AbstractRootCreateTagMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    public final function setRootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader(RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader) : void
    {
        $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    protected final function getRootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader() : RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader = $rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateGenericTagTermMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when creating a tag term', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateGenericTagTermMutationErrorPayloadUnionTypeDataLoader();
    }
}
