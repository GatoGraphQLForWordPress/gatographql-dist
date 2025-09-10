<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\MutationResolvers\CreateTaxonomyTermMutationResolverTrait;
/** @internal */
class CreatePostCategoryTermMutationResolver extends \PoPCMSSchema\PostCategoryMutations\MutationResolvers\AbstractMutatePostCategoryTermMutationResolver
{
    use CreateTaxonomyTermMutationResolverTrait;
}
