<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

interface WithArgumentsInterface extends \PoP\GraphQLParser\Spec\Parser\Ast\AstInterface
{
    public function hasArguments() : bool;
    public function hasArgument(string $name) : bool;
    /**
     * @return Argument[]
     */
    public function getArguments() : array;
    public function getArgument(string $name) : ?\PoP\GraphQLParser\Spec\Parser\Ast\Argument;
    /**
     * @return mixed
     */
    public function getArgumentValue(string $name);
    /**
     * @return array<string,mixed>
     */
    public function getArgumentKeyValues() : array;
    /**
     * Indicate if any of the Arguments contains a Promise
     */
    public function hasArgumentReferencingPromise() : bool;
    /**
     * Indicate if any of the Promises must be resolved on the Object
     */
    public function hasArgumentReferencingResolvedOnObjectPromise() : bool;
}
