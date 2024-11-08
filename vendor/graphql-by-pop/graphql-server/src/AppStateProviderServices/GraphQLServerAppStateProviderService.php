<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\AppStateProviderServices;

use PoPAPI\API\Response\Schemes;
use PoPAPI\API\Routing\RequestNature;
use PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter;
use PoP\Root\Facades\Instances\InstanceManagerFacade;
use PoP\Root\Services\StandaloneServiceTrait;
/** @internal */
class GraphQLServerAppStateProviderService implements \GraphQLByPoP\GraphQLServer\AppStateProviderServices\GraphQLServerAppStateProviderServiceInterface
{
    use StandaloneServiceTrait;
    /**
     * @var \PoPAPI\GraphQLAPI\DataStructureFormatters\GraphQLDataStructureFormatter|null
     */
    private $graphQLDataStructureFormatter;
    protected final function getGraphQLDataStructureFormatter() : GraphQLDataStructureFormatter
    {
        if ($this->graphQLDataStructureFormatter === null) {
            /** @var GraphQLDataStructureFormatter */
            $graphQLDataStructureFormatter = InstanceManagerFacade::getInstance()->getInstance(GraphQLDataStructureFormatter::class);
            $this->graphQLDataStructureFormatter = $graphQLDataStructureFormatter;
        }
        return $this->graphQLDataStructureFormatter;
    }
    /**
     * The required state to execute GraphQL queries.
     *
     * @return array<string,mixed>
     */
    public function getGraphQLRequestAppState() : array
    {
        return ['scheme' => Schemes::API, 'datastructure' => $this->getGraphQLDataStructureFormatter()->getName(), 'nature' => RequestNature::QUERY_ROOT];
    }
}
