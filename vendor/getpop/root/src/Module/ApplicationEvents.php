<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
class ApplicationEvents
{
    public const MODULE_LOADED = 'moduleLoaded';
    public const PRE_BOOT = 'preBoot';
    public const BOOT = 'boot';
    public const AFTER_BOOT = 'afterBoot';
}
