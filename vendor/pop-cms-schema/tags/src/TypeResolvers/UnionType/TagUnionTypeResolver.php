<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\UnionType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\UnionType\AbstractUnionTypeResolver;
use PoPCMSSchema\Tags\RelationalTypeDataLoaders\UnionType\TagUnionTypeDataLoader;
use PoPCMSSchema\Tags\TypeResolvers\InterfaceType\TagInterfaceTypeResolver;
/** @internal */
class TagUnionTypeResolver extends AbstractUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\Tags\RelationalTypeDataLoaders\UnionType\TagUnionTypeDataLoader|null
     */
    private $tagUnionTypeDataLoader;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InterfaceType\TagInterfaceTypeResolver|null
     */
    private $tagInterfaceTypeResolver;
    public final function setTagUnionTypeDataLoader(TagUnionTypeDataLoader $tagUnionTypeDataLoader) : void
    {
        $this->tagUnionTypeDataLoader = $tagUnionTypeDataLoader;
    }
    protected final function getTagUnionTypeDataLoader() : TagUnionTypeDataLoader
    {
        if ($this->tagUnionTypeDataLoader === null) {
            /** @var TagUnionTypeDataLoader */
            $tagUnionTypeDataLoader = $this->instanceManager->getInstance(TagUnionTypeDataLoader::class);
            $this->tagUnionTypeDataLoader = $tagUnionTypeDataLoader;
        }
        return $this->tagUnionTypeDataLoader;
    }
    public final function setTagInterfaceTypeResolver(TagInterfaceTypeResolver $tagInterfaceTypeResolver) : void
    {
        $this->tagInterfaceTypeResolver = $tagInterfaceTypeResolver;
    }
    protected final function getTagInterfaceTypeResolver() : TagInterfaceTypeResolver
    {
        if ($this->tagInterfaceTypeResolver === null) {
            /** @var TagInterfaceTypeResolver */
            $tagInterfaceTypeResolver = $this->instanceManager->getInstance(TagInterfaceTypeResolver::class);
            $this->tagInterfaceTypeResolver = $tagInterfaceTypeResolver;
        }
        return $this->tagInterfaceTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'TagUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'tag\' type resolvers', 'tags');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getTagUnionTypeDataLoader();
    }
    /**
     * @return InterfaceTypeResolverInterface[]
     */
    public function getUnionTypeInterfaceTypeResolvers() : array
    {
        return [$this->getTagInterfaceTypeResolver()];
    }
}
