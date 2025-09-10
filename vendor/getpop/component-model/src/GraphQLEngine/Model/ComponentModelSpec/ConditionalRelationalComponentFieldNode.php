<?php

declare (strict_types=1);
namespace PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec;

use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class ConditionalRelationalComponentFieldNode extends \PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\AbstractComponentFieldNode
{
    /**
     * The condition must be satisfied on the implicit field.
     * When the value of the field is `true`, load the conditional
     * domain switching fields.
     *
     * @param RelationalComponentFieldNode[] $relationalComponentFieldNodes
     */
    public function __construct(FieldInterface $field, protected array $relationalComponentFieldNodes)
    {
        parent::__construct($field);
    }
    /**
     * @return RelationalComponentFieldNode[]
     */
    public function getRelationalComponentFieldNodes() : array
    {
        return $this->relationalComponentFieldNodes;
    }
}
