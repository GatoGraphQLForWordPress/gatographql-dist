<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

/** @internal */
interface WithAstValueInterface
{
    public function getAstValue() : mixed;
}
