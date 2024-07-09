<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableCustomPostMediaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPostMediaMutations\Environment::USE_PAYLOADABLE_CUSTOMPOSTMEDIA_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableCustomPostMediaMutations() : bool
    {
        if (!$this->usePayloadableCustomPostMediaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\CustomPostMediaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_CUSTOMPOSTMEDIA_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
