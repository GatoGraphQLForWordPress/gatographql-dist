<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function getPageListDefaultLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Pages\Environment::PAGE_LIST_DEFAULT_LIMIT;
        $defaultValue = 10;
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function getPageListMaxLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Pages\Environment::PAGE_LIST_MAX_LIMIT;
        $defaultValue = -1;
        // Unlimited
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
