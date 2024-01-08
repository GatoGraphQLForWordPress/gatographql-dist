<?php

declare(strict_types=1);

namespace PoPCMSSchema\SettingsWP\TypeAPIs;

use PoPCMSSchema\Settings\TypeAPIs\AbstractSettingsTypeAPI;

class SettingsTypeAPI extends AbstractSettingsTypeAPI
{
    /**
     * If the name is non-existent, return `null`.
     * Otherwise, return the value.
     * @return mixed
     */
    protected function doGetOption(string $name)
    {
        return \get_option($name, null);
    }
}
