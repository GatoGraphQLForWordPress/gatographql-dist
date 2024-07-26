<?php

declare (strict_types=1);
namespace PoP\GuzzleHTTP;

use PoP\Root\Module\AbstractModuleConfiguration;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function getGuzzleRequestReferer() : ?string
    {
        $envVariable = \PoP\GuzzleHTTP\Environment::GUZZLE_REQUEST_REFERER;
        $defaultValue = null;
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue);
    }
}
