<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMeta;

use PoP\Root\Module\ModuleInterface;
use PoP\Root\Module\AbstractModule;
/** @internal */
class Module extends AbstractModule
{
    protected function requiresSatisfyingModule() : bool
    {
        return \true;
    }
    /**
     * @return array<class-string<ModuleInterface>>
     */
    public function getDependedModuleClasses() : array
    {
        return [\PoPCMSSchema\Meta\Module::class, \PoPCMSSchema\Users\Module::class];
    }
    /**
     * Initialize services
     *
     * @param array<class-string<ModuleInterface>> $skipSchemaModuleClasses
     */
    protected function initializeContainerServices(bool $skipSchema, array $skipSchemaModuleClasses) : void
    {
        $this->initSchemaServices(\dirname(__DIR__), $skipSchema);
    }
}
