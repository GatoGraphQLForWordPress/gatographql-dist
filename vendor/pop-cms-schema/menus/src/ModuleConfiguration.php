<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function getMenuListDefaultLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Menus\Environment::MENU_LIST_DEFAULT_LIMIT;
        $defaultValue = 10;
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function getMenuListMaxLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Menus\Environment::MENU_LIST_MAX_LIMIT;
        $defaultValue = -1;
        // Unlimited
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function treatMenuItemRawTitleFieldsAsSensitiveData() : bool
    {
        $envVariable = \PoPCMSSchema\Menus\Environment::TREAT_MENUITEM_RAW_TITLE_AS_SENSITIVE_DATA;
        $defaultValue = \true;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
