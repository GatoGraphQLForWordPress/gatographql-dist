<?php

declare (strict_types=1);
namespace PoP\Root\Constants;

/** @internal */
class HookNames
{
    public const AFTER_BOOT_APPLICATION = __CLASS__ . ':after-boot-application';
    public const APPLICATION_READY = __CLASS__ . ':application-ready';
    public const BEFORE_INITIALIZING_APP_STATE = __CLASS__ . ':before-initializing-app-state';
    public const AFTER_INITIALIZING_APP_STATE = __CLASS__ . ':after-initializing-app-state';
    public const APP_STATE_BEFORE_INITIALIZED = __CLASS__ . ':app-state-before-initialized';
    public const APP_STATE_INITIALIZED = __CLASS__ . ':app-state-initialized';
    public const APP_STATE_CONSOLIDATED = __CLASS__ . ':app-state-consolidated';
    public const APP_STATE_AUGMENTED = __CLASS__ . ':app-state-augmented';
    public const APP_STATE_COMPUTED = __CLASS__ . ':app-state-computed';
    public const APP_STATE_EXECUTED = __CLASS__ . ':app-state-executed';
}
