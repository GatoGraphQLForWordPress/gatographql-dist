<?php

declare (strict_types=1);
namespace PoP\ComponentModel\TypeResolvers;

use PoP\Root\App;
use PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface;
use PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface;
use PoP\ComponentModel\Schema\SchemaNamespacingServiceInterface;
use PoP\Root\Services\BasicServiceTrait;
/** @internal */
abstract class AbstractTypeResolver implements \PoP\ComponentModel\TypeResolvers\TypeResolverInterface
{
    use BasicServiceTrait;
    /**
     * @var array<string,mixed[]>|null
     */
    protected $schemaDefinition;
    /**
     * @var \PoP\ComponentModel\Schema\SchemaNamespacingServiceInterface|null
     */
    private $schemaNamespacingService;
    /**
     * @var \PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface|null
     */
    private $schemaDefinitionService;
    /**
     * @var \PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface|null
     */
    private $attachableExtensionManager;
    protected final function getSchemaNamespacingService() : SchemaNamespacingServiceInterface
    {
        if ($this->schemaNamespacingService === null) {
            /** @var SchemaNamespacingServiceInterface */
            $schemaNamespacingService = $this->instanceManager->getInstance(SchemaNamespacingServiceInterface::class);
            $this->schemaNamespacingService = $schemaNamespacingService;
        }
        return $this->schemaNamespacingService;
    }
    protected final function getSchemaDefinitionService() : SchemaDefinitionServiceInterface
    {
        if ($this->schemaDefinitionService === null) {
            /** @var SchemaDefinitionServiceInterface */
            $schemaDefinitionService = $this->instanceManager->getInstance(SchemaDefinitionServiceInterface::class);
            $this->schemaDefinitionService = $schemaDefinitionService;
        }
        return $this->schemaDefinitionService;
    }
    protected final function getAttachableExtensionManager() : AttachableExtensionManagerInterface
    {
        if ($this->attachableExtensionManager === null) {
            /** @var AttachableExtensionManagerInterface */
            $attachableExtensionManager = $this->instanceManager->getInstance(AttachableExtensionManagerInterface::class);
            $this->attachableExtensionManager = $attachableExtensionManager;
        }
        return $this->attachableExtensionManager;
    }
    public function getNamespace() : string
    {
        return $this->getSchemaNamespacingService()->getSchemaNamespace($this->getClassToNamespace());
    }
    protected function getClassToNamespace() : string
    {
        /** @var string */
        return \get_called_class();
    }
    public final function getNamespacedTypeName() : string
    {
        return $this->getSchemaNamespacingService()->getSchemaNamespacedName($this->getNamespace(), $this->getTypeName());
    }
    public final function getMaybeNamespacedTypeName() : string
    {
        return App::getState('namespace-types-and-interfaces') ? $this->getNamespacedTypeName() : $this->getTypeName();
    }
    public final function getTypeOutputKey() : string
    {
        // Do not make the first letter lowercase, or namespaced names look bad
        return $this->getMaybeNamespacedTypeName();
    }
    public function getTypeDescription() : ?string
    {
        return null;
    }
    public function isIntrospectionType() : bool
    {
        return \false;
    }
}
