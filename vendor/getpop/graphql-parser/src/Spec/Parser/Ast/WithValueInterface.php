<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

/** @internal */
interface WithValueInterface extends \PoP\GraphQLParser\Spec\Parser\Ast\AstInterface
{
    public function getValue() : mixed;
}
