<?php

declare (strict_types=1);
namespace PoP\Engine\StaticHelpers;

use PoP\GraphQLParser\Spec\Parser\Ast\OperationTypes;
class SuperRootHelper
{
    public static function getOperationFromSuperRootFieldName(string $superRootFieldName) : ?string
    {
        switch ($superRootFieldName) {
            case '_rootForQueryRoot':
            case '_queryRoot':
                return OperationTypes::QUERY;
            case '_rootForMutationRoot':
            case '_mutationRoot':
                return OperationTypes::MUTATION;
            default:
                return null;
        }
    }
}
