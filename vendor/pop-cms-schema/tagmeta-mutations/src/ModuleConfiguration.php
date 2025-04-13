<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableTagMetaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\TagMetaMutations\Environment::USE_PAYLOADABLE_TAG_META_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableTagMetaMutations() : bool
    {
        if (!$this->usePayloadableTagMetaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\TagMetaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_TAG_META_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
