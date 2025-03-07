<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\SchemaConfigurationExecuters;

use GatoGraphQL\GatoGraphQL\App;
use GatoGraphQL\GatoGraphQL\AppHelpers;
use GatoGraphQL\GatoGraphQL\Module;
use GatoGraphQL\GatoGraphQL\ModuleConfiguration;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\SchemaConfigurationFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface;
use PoP\Root\Services\AbstractBasicService;

abstract class AbstractSchemaConfigurationExecuter extends AbstractBasicService implements SchemaConfigurationExecuterInterface
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface|null
     */
    private $moduleRegistry;

    final protected function getModuleRegistry(): ModuleRegistryInterface
    {
        if ($this->moduleRegistry === null) {
            /** @var ModuleRegistryInterface */
            $moduleRegistry = $this->instanceManager->getInstance(ModuleRegistryInterface::class);
            $this->moduleRegistry = $moduleRegistry;
        }
        return $this->moduleRegistry;
    }

    public function getEnablingModule(): ?string
    {
        return null;
    }

    /**
     * Only enable the service, if the corresponding module is also enabled
     */
    public function isServiceEnabled(): bool
    {
        /**
         * Maybe do not initialize for the Internal AppThread
         *
         * @var ModuleConfiguration
         */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if (
            !$moduleConfiguration->useSchemaConfigurationInInternalGraphQLServer()
            && AppHelpers::isInternalGraphQLServerAppThread()
        ) {
            return false;
        }

        $moduleRegistry = $this->getModuleRegistry();
        if (
            !$moduleRegistry->isModuleEnabled(SchemaConfigurationFunctionalityModuleResolver::SCHEMA_CONFIGURATION)
            && !$this->mustAlsoExecuteWhenSchemaConfigurationModuleIsDisabled()
        ) {
            return false;
        }

        $enablingModule = $this->getEnablingModule();
        if ($enablingModule !== null) {
            return $moduleRegistry->isModuleEnabled($enablingModule);
        }
        return true;
    }

    protected function mustAlsoExecuteWhenSchemaConfigurationModuleIsDisabled(): bool
    {
        return false;
    }

    /**
     * By default, do nothing
     */
    public function executeNoneAppliedSchemaConfiguration(): void
    {
    }
}
