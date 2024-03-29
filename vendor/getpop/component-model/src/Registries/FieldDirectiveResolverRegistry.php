<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Registries;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
class FieldDirectiveResolverRegistry implements \PoP\ComponentModel\Registries\FieldDirectiveResolverRegistryInterface
{
    /**
     * @var array<string,FieldDirectiveResolverInterface>
     */
    protected $fieldDirectiveResolvers = [];
    public function addFieldDirectiveResolver(FieldDirectiveResolverInterface $fieldDirectiveResolver) : void
    {
        $this->fieldDirectiveResolvers[$fieldDirectiveResolver->getDirectiveName()] = $fieldDirectiveResolver;
    }
    /**
     * @return array<string,FieldDirectiveResolverInterface>
     */
    public function getFieldDirectiveResolvers() : array
    {
        return $this->fieldDirectiveResolvers;
    }
    public function getFieldDirectiveResolver(string $directiveName) : ?FieldDirectiveResolverInterface
    {
        return $this->fieldDirectiveResolvers[$directiveName] ?? null;
    }
}
