<?php

declare (strict_types=1);
namespace PoP\GraphQLParser;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    public function enableMultipleQueryExecution() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::ENABLE_MULTIPLE_QUERY_EXECUTION;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function enableMultiFieldDirectives() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::ENABLE_MULTIFIELD_DIRECTIVES;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function enableComposableDirectives() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::ENABLE_COMPOSABLE_DIRECTIVES;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function enableDynamicVariables() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::ENABLE_DYNAMIC_VARIABLES;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function enableObjectResolvedFieldValueReferences() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::ENABLE_RESOLVED_FIELD_VARIABLE_REFERENCES;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function useLastOperationInDocumentForMultipleQueryExecutionWhenOperationNameNotProvided() : bool
    {
        $envVariable = \PoP\GraphQLParser\Environment::USE_LAST_OPERATION_IN_DOCUMENT_FOR_MULTIPLE_QUERY_EXECUTION_WHEN_OPERATION_NAME_NOT_PROVIDED;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
