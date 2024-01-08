<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\State;

use GatoGraphQL\GatoGraphQL\Services\EndpointExecuters\GraphQLQueryResolutionEndpointExecuterInterface;
use GatoGraphQL\GatoGraphQL\Services\EndpointExecuters\CustomEndpointGraphQLQueryResolutionEndpointExecuter;

class CustomEndpointGraphQLQueryResolutionEndpointExecuterAppStateProvider extends AbstractGraphQLQueryResolutionEndpointExecuterAppStateProvider
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\EndpointExecuters\CustomEndpointGraphQLQueryResolutionEndpointExecuter|null
     */
    private $customEndpointGraphQLQueryResolutionEndpointExecuter;

    final public function setCustomEndpointGraphQLQueryResolutionEndpointExecuter(CustomEndpointGraphQLQueryResolutionEndpointExecuter $customEndpointGraphQLQueryResolutionEndpointExecuter): void
    {
        $this->customEndpointGraphQLQueryResolutionEndpointExecuter = $customEndpointGraphQLQueryResolutionEndpointExecuter;
    }
    final protected function getCustomEndpointGraphQLQueryResolutionEndpointExecuter(): CustomEndpointGraphQLQueryResolutionEndpointExecuter
    {
        if ($this->customEndpointGraphQLQueryResolutionEndpointExecuter === null) {
            /** @var CustomEndpointGraphQLQueryResolutionEndpointExecuter */
            $customEndpointGraphQLQueryResolutionEndpointExecuter = $this->instanceManager->getInstance(CustomEndpointGraphQLQueryResolutionEndpointExecuter::class);
            $this->customEndpointGraphQLQueryResolutionEndpointExecuter = $customEndpointGraphQLQueryResolutionEndpointExecuter;
        }
        return $this->customEndpointGraphQLQueryResolutionEndpointExecuter;
    }

    protected function getGraphQLQueryResolutionEndpointExecuter(): GraphQLQueryResolutionEndpointExecuterInterface
    {
        return $this->getCustomEndpointGraphQLQueryResolutionEndpointExecuter();
    }
}
