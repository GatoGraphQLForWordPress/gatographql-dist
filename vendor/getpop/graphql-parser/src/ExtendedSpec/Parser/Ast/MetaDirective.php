<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\ExtendedSpec\Parser\Ast;

use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
use PoP\GraphQLParser\Spec\Parser\Location;
/** @internal */
class MetaDirective extends Directive
{
    /**
     * @var Directive[]
     */
    protected $nestedDirectives;
    /**
     * @param Directive[] $nestedDirectives
     * @param Argument[] $arguments
     */
    public function __construct(string $name, array $arguments, array $nestedDirectives, Location $location)
    {
        $this->nestedDirectives = $nestedDirectives;
        parent::__construct($name, $arguments, $location);
        $this->setNestedDirectives($nestedDirectives);
    }
    public function hasNestedDirectives() : bool
    {
        return \count($this->nestedDirectives) > 0;
    }
    /**
     * @return Directive[]
     */
    public function getNestedDirectives() : array
    {
        return $this->nestedDirectives;
    }
    /**
     * @param Directive[] $nestedDirectives
     */
    public function setNestedDirectives(array $nestedDirectives) : void
    {
        $this->nestedDirectives = $nestedDirectives;
    }
    public function addNestedDirective(Directive $nestedDirective) : void
    {
        $this->nestedDirectives[] = $nestedDirective;
    }
    public function prependNestedDirective(Directive $nestedDirective) : void
    {
        \array_unshift($this->nestedDirectives, $nestedDirective);
    }
}
