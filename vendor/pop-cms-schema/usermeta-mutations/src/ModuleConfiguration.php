<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableUserMetaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\UserMetaMutations\Environment::USE_PAYLOADABLE_USER_META_MUTATIONS;
        $defaultValue = \true;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableUserMetaMutations() : bool
    {
        if (!$this->usePayloadableUserMetaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\UserMetaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_USER_META_MUTATIONS;
        $defaultValue = \false;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
