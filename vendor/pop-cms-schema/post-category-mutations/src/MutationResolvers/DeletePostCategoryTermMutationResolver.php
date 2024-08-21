<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteCategoryTermMutationResolverTrait;
/** @internal */
class DeletePostCategoryTermMutationResolver extends \PoPCMSSchema\PostCategoryMutations\MutationResolvers\AbstractMutatePostCategoryTermMutationResolver
{
    use DeleteCategoryTermMutationResolverTrait;
}
