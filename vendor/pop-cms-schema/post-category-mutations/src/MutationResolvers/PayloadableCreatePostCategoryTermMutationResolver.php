<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableCreateCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableCreatePostCategoryTermMutationResolver extends \PoPCMSSchema\PostCategoryMutations\MutationResolvers\AbstractMutatePostCategoryTermMutationResolver
{
    use PayloadableCreateCategoryTermMutationResolverTrait;
}
