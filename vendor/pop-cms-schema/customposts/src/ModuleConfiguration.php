<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function allowQueryingPrivateCPTs() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::ALLOW_QUERYING_PRIVATE_CPTS;
        $defaultValue = \false;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function getCustomPostListDefaultLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::CUSTOMPOST_LIST_DEFAULT_LIMIT;
        $defaultValue = 10;
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function getCustomPostListMaxLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::CUSTOMPOST_LIST_MAX_LIMIT;
        $defaultValue = -1;
        // Unlimited
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function useSingleTypeInsteadOfCustomPostUnionType() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::USE_SINGLE_TYPE_INSTEAD_OF_CUSTOMPOST_UNION_TYPE;
        $defaultValue = \false;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function treatCustomPostStatusAsSensitiveData() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::TREAT_CUSTOMPOST_STATUS_AS_SENSITIVE_DATA;
        $defaultValue = \true;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function treatCustomPostRawContentFieldsAsSensitiveData() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::TREAT_CUSTOMPOST_RAW_CONTENT_FIELDS_AS_SENSITIVE_DATA;
        $defaultValue = \true;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    /**
     * @return string[]
     */
    public function getQueryableCustomPostTypes() : array
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::QUERYABLE_CUSTOMPOST_TYPES;
        $defaultValue = [];
        $callback = EnvironmentValueHelpers::commaSeparatedStringToArray(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function disablePackagesAddingDefaultQueryableCustomTypes() : bool
    {
        $envVariable = \PoPCMSSchema\CustomPosts\Environment::DISABLE_PACKAGES_ADDING_DEFAULT_QUERYABLE_CUSTOMPOST_TYPES;
        $defaultValue = \false;
        $callback = EnvironmentValueHelpers::toBool(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
