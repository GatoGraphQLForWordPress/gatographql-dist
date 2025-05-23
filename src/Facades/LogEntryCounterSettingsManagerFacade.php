<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Facades;

use GatoGraphQL\GatoGraphQL\Settings\LogEntryCounterSettingsManager;
use GatoGraphQL\GatoGraphQL\Settings\LogEntryCounterSettingsManagerInterface;

/**
 * Obtain an instance of the LogEntryCounterSettingsManager.
 * Manage the instance internally instead of using the ContainerBuilder,
 * because it is required for setting configuration values before components
 * are initialized, so the ContainerBuilder is still unavailable
 */
class LogEntryCounterSettingsManagerFacade
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\LogEntryCounterSettingsManagerInterface|null
     */
    private static $instance;

    public static function getInstance(): LogEntryCounterSettingsManagerInterface
    {
        if (self::$instance === null) {
            self::$instance = new LogEntryCounterSettingsManager();
        }
        return self::$instance;
    }
}
