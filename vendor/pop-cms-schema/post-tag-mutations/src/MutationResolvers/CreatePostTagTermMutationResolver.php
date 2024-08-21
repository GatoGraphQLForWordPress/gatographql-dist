<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TaxonomyMutations\MutationResolvers\CreateTaxonomyTermMutationResolverTrait;
/** @internal */
class CreatePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use CreateTaxonomyTermMutationResolverTrait;
}
