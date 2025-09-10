<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableUpdateCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableUpdatePostCategoryTermMutationResolver extends \PoPCMSSchema\PostCategoryMutations\MutationResolvers\AbstractMutatePostCategoryTermMutationResolver
{
    use PayloadableUpdateCategoryTermMutationResolverTrait;
}
