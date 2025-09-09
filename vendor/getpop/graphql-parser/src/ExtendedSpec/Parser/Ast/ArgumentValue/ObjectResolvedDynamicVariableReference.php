<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\ExtendedSpec\Parser\Ast\ArgumentValue;

use PoP\GraphQLParser\ExtendedSpec\Execution\ObjectResolvedDynamicVariableValuePromise;
/** @internal */
class ObjectResolvedDynamicVariableReference extends \PoP\GraphQLParser\ExtendedSpec\Parser\Ast\ArgumentValue\AbstractDynamicVariableReference
{
    public function getValue() : mixed
    {
        return new ObjectResolvedDynamicVariableValuePromise($this);
    }
}
