<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLEndpointForWP\State;

use GraphQLByPoP\GraphQLEndpointForWP\EndpointHandlers\GraphQLEndpointHandler;
use PoPAPI\APIEndpoints\EndpointHandlerInterface;
use PoPAPI\APIEndpointsForWP\State\AbstractAPIEndpointHandlerAppStateProvider;
use PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter;

class GraphQLEndpointHandlerAppStateProvider extends AbstractAPIEndpointHandlerAppStateProvider
{
    /**
     * @var \PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter|null
     */
    private $graphQLDataStructureFormatter;
    /**
     * @var \GraphQLByPoP\GraphQLEndpointForWP\EndpointHandlers\GraphQLEndpointHandler|null
     */
    private $graphQLEndpointHandler;

    final protected function getGraphQLDataStructureFormatter(): GraphQLDataStructureFormatter
    {
        if ($this->graphQLDataStructureFormatter === null) {
            /** @var GraphQLDataStructureFormatter */
            $graphQLDataStructureFormatter = $this->instanceManager->getInstance(GraphQLDataStructureFormatter::class);
            $this->graphQLDataStructureFormatter = $graphQLDataStructureFormatter;
        }
        return $this->graphQLDataStructureFormatter;
    }
    final protected function getGraphQLEndpointHandler(): GraphQLEndpointHandler
    {
        if ($this->graphQLEndpointHandler === null) {
            /** @var GraphQLEndpointHandler */
            $graphQLEndpointHandler = $this->instanceManager->getInstance(GraphQLEndpointHandler::class);
            $this->graphQLEndpointHandler = $graphQLEndpointHandler;
        }
        return $this->graphQLEndpointHandler;
    }

    protected function getEndpointHandler(): EndpointHandlerInterface
    {
        return $this->getGraphQLEndpointHandler();
    }

    /**
     * @param array<string,mixed> $state
     */
    public function initialize(array &$state): void
    {
        parent::initialize($state);
        $state['datastructure'] = $this->getGraphQLDataStructureFormatter()->getName();
    }
}
