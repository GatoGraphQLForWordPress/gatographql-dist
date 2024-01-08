<?php

declare (strict_types=1);
namespace PoP\Root;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function enablePassingStateViaRequest() : bool
    {
        $envVariable = \PoP\Root\Environment::ENABLE_PASSING_STATE_VIA_REQUEST;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function enablePassingRoutingStateViaRequest() : bool
    {
        if (!$this->enablePassingStateViaRequest()) {
            return \false;
        }
        $envVariable = \PoP\Root\Environment::ENABLE_PASSING_ROUTING_STATE_VIA_REQUEST;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    protected function enableHook(string $envVariable) : bool
    {
        switch ($envVariable) {
            case \PoP\Root\Environment::ENABLE_PASSING_STATE_VIA_REQUEST:
            case \PoP\Root\Environment::ENABLE_PASSING_ROUTING_STATE_VIA_REQUEST:
                return \false;
            default:
                return parent::enableHook($envVariable);
        }
    }
}
