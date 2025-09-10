<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser\Ast;

use PoP\GraphQLParser\Spec\Parser\Location;
/** @internal */
class InlineFragment extends \PoP\GraphQLParser\Spec\Parser\Ast\AbstractAst implements \PoP\GraphQLParser\Spec\Parser\Ast\FragmentBondInterface, \PoP\GraphQLParser\Spec\Parser\Ast\WithDirectivesInterface, \PoP\GraphQLParser\Spec\Parser\Ast\WithFieldsOrFragmentBondsInterface
{
    use \PoP\GraphQLParser\Spec\Parser\Ast\WithDirectivesTrait;
    use \PoP\GraphQLParser\Spec\Parser\Ast\WithFieldsOrFragmentBondsTrait;
    /**
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     * @param Directive[] $directives
     */
    public function __construct(protected readonly string $typeName, array $fieldsOrFragmentBonds, array $directives, Location $location)
    {
        parent::__construct($location);
        $this->setDirectives($directives);
        $this->setFieldsOrFragmentBonds($fieldsOrFragmentBonds);
    }
    protected function doAsQueryString() : string
    {
        // Generate the string for directives
        $strInlineFragmentDirectives = '';
        if ($this->directives !== []) {
            $strDirectives = [];
            foreach ($this->directives as $directive) {
                $strDirectives[] = $directive->asQueryString();
            }
            $strInlineFragmentDirectives = \sprintf(' %s', \implode(' ', $strDirectives));
        }
        // Generate the string for the body of the fragment
        $strInlineFragmentFieldsOrFragmentBonds = '';
        if ($this->fieldsOrFragmentBonds !== []) {
            $strFieldsOrFragmentBonds = [];
            foreach ($this->fieldsOrFragmentBonds as $fieldsOrFragmentBond) {
                $strFieldsOrFragmentBonds[] = $fieldsOrFragmentBond->asQueryString();
            }
            $strInlineFragmentFieldsOrFragmentBonds = \sprintf(' %s ', \implode(' ', $strFieldsOrFragmentBonds));
        }
        return \sprintf('...on %s%s {%s}', $this->typeName, $strInlineFragmentDirectives, $strInlineFragmentFieldsOrFragmentBonds);
    }
    protected function doAsASTNodeString() : string
    {
        return \sprintf('...on %s { ... }', $this->typeName);
    }
    public function getTypeName() : string
    {
        return $this->typeName;
    }
}
