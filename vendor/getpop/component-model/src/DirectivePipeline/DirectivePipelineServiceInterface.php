<?php

declare (strict_types=1);
namespace PoP\ComponentModel\DirectivePipeline;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
/** @internal */
interface DirectivePipelineServiceInterface
{
    /**
     * @param FieldDirectiveResolverInterface[] $directiveResolvers
     */
    public function getDirectivePipeline(array $directiveResolvers) : \PoP\ComponentModel\DirectivePipeline\DirectivePipelineDecorator;
}
