<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Registries;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
interface FieldDirectiveResolverRegistryInterface
{
    public function addFieldDirectiveResolver(FieldDirectiveResolverInterface $fieldDirectiveResolver) : void;
    /**
     * @return array<string,FieldDirectiveResolverInterface>
     */
    public function getFieldDirectiveResolvers() : array;
    public function getFieldDirectiveResolver(string $directiveName) : ?FieldDirectiveResolverInterface;
}
