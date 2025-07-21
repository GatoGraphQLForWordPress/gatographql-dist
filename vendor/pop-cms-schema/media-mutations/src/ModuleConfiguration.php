<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableMediaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\MediaMutations\Environment::USE_PAYLOADABLE_MEDIA_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableMediaMutations() : bool
    {
        if (!$this->usePayloadableMediaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\MediaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_MEDIA_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function rejectUnsafeURLs() : bool
    {
        $envVariable = \PoPCMSSchema\MediaMutations\Environment::REJECT_UNSAFE_URLS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
