<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableCustomPostMetaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPostMetaMutations\Environment::USE_PAYLOADABLE_CUSTOMPOST_META_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableCustomPostMetaMutations() : bool
    {
        if (!$this->usePayloadableCustomPostMetaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\CustomPostMetaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_CUSTOMPOST_META_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
