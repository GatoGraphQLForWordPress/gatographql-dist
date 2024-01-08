<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

/** @internal */
class MutationOperation extends \PoP\GraphQLParser\Spec\Parser\Ast\AbstractOperation
{
    public function getOperationType() : string
    {
        return \PoP\GraphQLParser\Spec\Parser\Ast\OperationTypes::MUTATION;
    }
}
