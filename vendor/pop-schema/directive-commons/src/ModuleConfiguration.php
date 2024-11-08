<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function nestErrorsInMetaDirectives() : bool
    {
        $envVariable = \PoPSchema\DirectiveCommons\Environment::NEST_ERRORS_IN_META_DIRECTIVES;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
