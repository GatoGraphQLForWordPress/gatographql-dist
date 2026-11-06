<?php

declare (strict_types=1);
namespace PoPSchema\Logger;

use PoPSchema\Logger\Enums\LoggerSeverity;
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
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    /**
     * @return LoggerSeverity[]
     */
    public function enableLogsBySeverity() : array
    {
        $envVariable = \PoPSchema\Logger\Environment::ENABLE_LOGS_BY_SEVERITY;
        $defaultValue = [LoggerSeverity::ERROR->value, LoggerSeverity::WARNING->value, LoggerSeverity::INFO->value, LoggerSeverity::DEBUG->value];
        $callback = EnvironmentValueHelpers::commaSeparatedStringToArray(...);
        /** @var string[] */
        $severities = $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
        return \array_values(\array_filter(\array_map(LoggerSeverity::tryFrom(...), $severities)));
    }
}
