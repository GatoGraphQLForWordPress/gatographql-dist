<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\MutationResolvers;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
interface TaxonomyTermMutationResolverInterface extends MutationResolverInterface
{
    public function getTaxonomyName() : string;
}
