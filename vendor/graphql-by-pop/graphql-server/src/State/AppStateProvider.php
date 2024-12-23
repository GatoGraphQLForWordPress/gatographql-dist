<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\State;

use GraphQLByPoP\GraphQLServer\Module;
use GraphQLByPoP\GraphQLServer\ModuleConfiguration;
use PoP\Root\App;
use PoP\Root\State\AbstractAppStateProvider;
use PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter;
/** @internal */
class AppStateProvider extends AbstractAppStateProvider
{
    /**
     * @var \PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter|null
     */
    private $graphQLDataStructureFormatter;
    protected final function getGraphQLDataStructureFormatter() : GraphQLDataStructureFormatter
    {
        if ($this->graphQLDataStructureFormatter === null) {
            /** @var GraphQLDataStructureFormatter */
            $graphQLDataStructureFormatter = $this->instanceManager->getInstance(GraphQLDataStructureFormatter::class);
            $this->graphQLDataStructureFormatter = $graphQLDataStructureFormatter;
        }
        return $this->graphQLDataStructureFormatter;
    }
    /**
     * @param array<string,mixed> $state
     */
    public function execute(array &$state) : void
    {
        /**
         * Call ModuleConfiguration only after hooks from
         * SchemaConfigurationExecuter have been initialized.
         * That's why these are called on `execute` and not `initialize`.
         *
         * @var ModuleConfiguration
         */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $state['graphql-introspection-enabled'] = $moduleConfiguration->enableGraphQLIntrospection() ?? \true;
    }
}
