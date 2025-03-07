<?php

declare (strict_types=1);
namespace PoP\Engine\TypeResolvers\ObjectType;

use PoP\Root\App;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoP\Engine\ObjectModels\Root;
use PoP\Engine\RelationalTypeDataLoaders\ObjectType\RootObjectTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\CanonicalTypeNameTypeResolverTrait;
/** @internal */
class RootObjectTypeResolver extends AbstractObjectTypeResolver
{
    use CanonicalTypeNameTypeResolverTrait;
    public const HOOK_DESCRIPTION = __CLASS__ . ':description';
    /**
     * @var \PoP\Engine\RelationalTypeDataLoaders\ObjectType\RootObjectTypeDataLoader|null
     */
    private $rootObjectTypeDataLoader;
    protected final function getRootObjectTypeDataLoader() : RootObjectTypeDataLoader
    {
        if ($this->rootObjectTypeDataLoader === null) {
            /** @var RootObjectTypeDataLoader */
            $rootObjectTypeDataLoader = $this->instanceManager->getInstance(RootObjectTypeDataLoader::class);
            $this->rootObjectTypeDataLoader = $rootObjectTypeDataLoader;
        }
        return $this->rootObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'Root';
    }
    public function getTypeDescription() : ?string
    {
        return App::applyFilters(self::HOOK_DESCRIPTION, $this->__('Root type, starting from which the query is executed', 'engine'));
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        /** @var Root */
        $root = $object;
        return $root->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootObjectTypeDataLoader();
    }
}
