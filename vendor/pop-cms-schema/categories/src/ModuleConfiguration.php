<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function getCategoryListDefaultLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Categories\Environment::CATEGORY_LIST_DEFAULT_LIMIT;
        $defaultValue = 10;
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function getCategoryListMaxLimit() : ?int
    {
        $envVariable = \PoPCMSSchema\Categories\Environment::CATEGORY_LIST_MAX_LIMIT;
        $defaultValue = -1;
        // Unlimited
        $callback = EnvironmentValueHelpers::toInt(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    /**
     * @return string[]
     */
    public function getQueryableCategoryTaxonomies() : array
    {
        $envVariable = \PoPCMSSchema\Categories\Environment::QUERYABLE_CATEGORY_TAXONOMIES;
        $defaultValue = [];
        $callback = EnvironmentValueHelpers::commaSeparatedStringToArray(...);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
