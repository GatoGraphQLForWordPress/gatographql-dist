<?php

declare (strict_types=1);
namespace PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec;

use PoP\ComponentModel\Component\Component;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\RelationalField;
/** @internal */
class RelationalComponentFieldNode extends \PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\AbstractComponentFieldNode
{
    /**
     * @var Component[]
     */
    protected $nestedComponents;
    /**
     * @param Component[] $nestedComponents
     */
    public function __construct(FieldInterface $field, array $nestedComponents)
    {
        $this->nestedComponents = $nestedComponents;
        parent::__construct($field);
    }
    /**
     * Retrieve a new instance with all the properties from the RelationalField
     *
     * @param Component[] $nestedComponents
     */
    public static function fromRelationalField(RelationalField $relationalField, array $nestedComponents) : self
    {
        return new self($relationalField, $nestedComponents);
    }
    /**
     * @return Component[]
     */
    public function getNestedComponents() : array
    {
        return $this->nestedComponents;
    }
}
