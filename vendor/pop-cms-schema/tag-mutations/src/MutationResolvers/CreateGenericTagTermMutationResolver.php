<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\MutationResolvers\CreateTaxonomyTermMutationResolverTrait;
/** @internal */
class CreateGenericTagTermMutationResolver extends \PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use CreateTaxonomyTermMutationResolverTrait;
}
