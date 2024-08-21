<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\MutationResolvers\CreateTaxonomyTermMutationResolverTrait;
/** @internal */
class CreateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use CreateTaxonomyTermMutationResolverTrait;
}
