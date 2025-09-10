<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableDeleteCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableDeletePostCategoryTermMutationResolver extends \PoPCMSSchema\PostCategoryMutations\MutationResolvers\AbstractMutatePostCategoryTermMutationResolver
{
    use PayloadableDeleteCategoryTermMutationResolverTrait;
}
