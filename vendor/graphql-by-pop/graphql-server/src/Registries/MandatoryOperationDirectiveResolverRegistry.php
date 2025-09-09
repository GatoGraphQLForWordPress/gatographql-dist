<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\Registries;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
class MandatoryOperationDirectiveResolverRegistry implements \GraphQLByPoP\GraphQLServer\Registries\MandatoryOperationDirectiveResolverRegistryInterface
{
    /**
     * @var FieldDirectiveResolverInterface[]
     */
    protected array $mandatoryOperationDirectiveResolvers = [];
    public function addMandatoryOperationDirectiveResolver(FieldDirectiveResolverInterface $directiveResolver) : void
    {
        $this->mandatoryOperationDirectiveResolvers[] = $directiveResolver;
    }
    /**
     * @return FieldDirectiveResolverInterface[]
     */
    public function getMandatoryOperationDirectiveResolvers() : array
    {
        return $this->mandatoryOperationDirectiveResolvers;
    }
}
