<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\MutationResolvers\CreateTaxonomyTermMutationResolverTrait;
/** @internal */
class CreateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use CreateTaxonomyTermMutationResolverTrait;
}
