<?php

declare (strict_types=1);
namespace PoP\ComponentModel\GraphQLEngine\Model;

use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/**
 * This class represents a Field, and all the fragment models that must be
 * satisfied in order to resolve the field.
 *
 * Eg: Models for field "posts"
 * { posts } => []
 * { ...on CustomPost { posts } } => ["CustomPost"]
 * { ...on CustomPost { ...on Post { posts } } } => ["CustomPost", "Post"]
 * @internal
 */
class FieldFragmentModelsTuple
{
    /**
     * @var \PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface
     */
    protected $field;
    /**
     * @var string[]
     */
    protected $fragmentModels = [];
    /**
     * @param string[] $fragmentModels For fields within fragments, this value represents all the fragment "Model(s)" that must be satisfied to resolve the field
     */
    public function __construct(FieldInterface $field, array $fragmentModels = [])
    {
        $this->field = $field;
        $this->fragmentModels = $fragmentModels;
    }
    public function getField() : FieldInterface
    {
        return $this->field;
    }
    /**
     * @return string[]
     */
    public function getFragmentModels() : array
    {
        return $this->fragmentModels;
    }
    public function addFragmentModel(string $fragmentModel) : void
    {
        if (\in_array($fragmentModel, $this->fragmentModels)) {
            return;
        }
        $this->fragmentModels[] = $fragmentModel;
    }
}
