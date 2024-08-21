<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations;

use PoP\Root\Module\AbstractModule;
use PoP\Root\Module\ModuleInterface;
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
        return [\PoPCMSSchema\Taxonomies\Module::class, \PoPCMSSchema\UserRoles\Module::class, \PoPCMSSchema\UserStateMutations\Module::class];
    }
    /**
     * Initialize services
     *
     * @param array<class-string<ModuleInterface>> $skipSchemaModuleClasses
     */
    protected function initializeContainerServices(bool $skipSchema, array $skipSchemaModuleClasses) : void
    {
        $this->initServices(\dirname(__DIR__));
        $this->initSchemaServices(\dirname(__DIR__), $skipSchema);
    }
}
