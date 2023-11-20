<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\ExtendedSpec\Parser\Ast\ArgumentValue;

use PoP\GraphQLParser\ExtendedSpec\Execution\DocumentDynamicVariableValuePromise;
/** @internal */
class DocumentDynamicVariableReference extends \PoP\GraphQLParser\ExtendedSpec\Parser\Ast\ArgumentValue\AbstractDynamicVariableReference
{
    /**
     * @return mixed
     */
    public function getValue()
    {
        return new DocumentDynamicVariableValuePromise($this);
    }
}
