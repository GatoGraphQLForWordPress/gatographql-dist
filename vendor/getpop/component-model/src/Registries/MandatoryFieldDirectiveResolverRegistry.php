<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Registries;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
class MandatoryFieldDirectiveResolverRegistry implements \PoP\ComponentModel\Registries\MandatoryFieldDirectiveResolverRegistryInterface
{
    /**
     * @var FieldDirectiveResolverInterface[]
     */
    protected array $mandatoryFieldDirectiveResolvers = [];
    public function addMandatoryFieldDirectiveResolver(FieldDirectiveResolverInterface $directiveResolver) : void
    {
        $this->mandatoryFieldDirectiveResolvers[] = $directiveResolver;
    }
    /**
     * @return FieldDirectiveResolverInterface[]
     */
    public function getMandatoryFieldDirectiveResolvers() : array
    {
        return $this->mandatoryFieldDirectiveResolvers;
    }
}
