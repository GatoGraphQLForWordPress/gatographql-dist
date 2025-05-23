<?php

declare (strict_types=1);
namespace PoPSchema\Logger;

use PoPSchema\Logger\Constants\LoggerSeverity;
use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function getLogsDir() : ?string
    {
        $envVariable = \PoPSchema\Logger\Environment::LOGS_DIR;
        $defaultValue = null;
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue);
    }
    public function enableLogs() : bool
    {
        if ($this->getLogsDir() === null) {
            return \false;
        }
        $envVariable = \PoPSchema\Logger\Environment::ENABLE_LOGS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    /**
     * @return string[]
     */
    public function enableLogsBySeverity() : array
    {
        $envVariable = \PoPSchema\Logger\Environment::ENABLE_LOGS_BY_SEVERITY;
        $defaultValue = [LoggerSeverity::ERROR, LoggerSeverity::WARNING, LoggerSeverity::INFO, LoggerSeverity::DEBUG];
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'commaSeparatedStringToArray']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
