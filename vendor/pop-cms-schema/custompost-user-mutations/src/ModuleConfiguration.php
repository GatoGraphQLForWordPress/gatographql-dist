<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostUserMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function treatAuthorInputInCustomPostMutationAsSensitiveData() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPostUserMutations\Environment::TREAT_AUTHOR_INPUT_IN_CUSTOMPOST_MUTATION_AS_SENSITIVE_DATA;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
