<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableUserStateMutations() : bool
    {
        $envVariable = \PoPCMSSchema\UserStateMutations\Environment::USE_PAYLOADABLE_USERSTATE_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableUserStateMutations() : bool
    {
        if (!$this->usePayloadableUserStateMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\UserStateMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_USERSTATE_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
