<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

use PoP\GraphQLParser\Spec\Parser\Location;
/** @internal */
class FragmentReference extends \PoP\GraphQLParser\Spec\Parser\Ast\AbstractAst implements \PoP\GraphQLParser\Spec\Parser\Ast\FragmentBondInterface, \PoP\GraphQLParser\Spec\Parser\Ast\WithDirectivesInterface
{
    use \PoP\GraphQLParser\Spec\Parser\Ast\WithDirectivesTrait;
    /**
     * @param Directive[] $directives
     */
    public function __construct(protected readonly string $name, Location $location, array $directives = [])
    {
        parent::__construct($location);
        $this->setDirectives($directives);
    }
    protected function doAsQueryString() : string
    {
        $strDirectives = '';
        if ($this->directives !== []) {
            $strDirectives = ' ' . \implode(' ', \array_map(fn(\PoP\GraphQLParser\Spec\Parser\Ast\Directive $directive) => $directive->asQueryString(), $this->directives));
        }
        return \sprintf('...%s%s', $this->name, $strDirectives);
    }
    protected function doAsASTNodeString() : string
    {
        return \sprintf('...%s', $this->name);
    }
    public function getName() : string
    {
        return $this->name;
    }
}
