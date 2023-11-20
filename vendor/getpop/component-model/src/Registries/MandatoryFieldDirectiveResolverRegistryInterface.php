<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Registries;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
interface MandatoryFieldDirectiveResolverRegistryInterface
{
    public function addMandatoryFieldDirectiveResolver(FieldDirectiveResolverInterface $directiveResolver) : void;
    /**
     * @return FieldDirectiveResolverInterface[]
     */
    public function getMandatoryFieldDirectiveResolvers() : array;
}
