<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableCustomPostCategoryMutations() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPostCategoryMutations\Environment::USE_PAYLOADABLE_CUSTOMPOSTCATEGORY_MUTATIONS;
        $defaultValue = \true;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableCustomPostCategoryMutations() : bool
    {
        if (!$this->usePayloadableCustomPostCategoryMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\CustomPostCategoryMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_CUSTOMPOSTCATEGORY_MUTATIONS;
        $defaultValue = \false;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
