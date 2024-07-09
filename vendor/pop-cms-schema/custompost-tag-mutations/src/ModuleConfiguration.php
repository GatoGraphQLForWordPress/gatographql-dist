<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableCustomPostTagMutations() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPostTagMutations\Environment::USE_PAYLOADABLE_CUSTOMPOSTTAG_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableCustomPostTagMutations() : bool
    {
        if (!$this->usePayloadableCustomPostTagMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\CustomPostTagMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_CUSTOMPOSTTAG_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
