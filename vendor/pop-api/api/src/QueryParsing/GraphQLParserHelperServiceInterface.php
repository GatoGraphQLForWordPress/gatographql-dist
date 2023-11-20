<?php

declare (strict_types=1);
namespace PoPAPI\API\QueryParsing;

use PoP\GraphQLParser\Exception\Parser\LogicErrorParserException;
use PoP\GraphQLParser\Exception\FeatureNotSupportedException;
use PoP\GraphQLParser\Exception\Parser\SyntaxErrorParserException;
use PoPAPI\API\ObjectModels\GraphQLQueryParsingPayload;
/** @internal */
interface GraphQLParserHelperServiceInterface
{
    /**
     * @throws SyntaxErrorParserException
     * @throws FeatureNotSupportedException
     * @throws LogicErrorParserException
     * @param array<string,mixed> $variableValues
     */
    public function parseGraphQLQuery(string $query, array $variableValues, ?string $operationName) : GraphQLQueryParsingPayload;
}
