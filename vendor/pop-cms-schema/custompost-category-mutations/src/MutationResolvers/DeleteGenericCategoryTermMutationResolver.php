<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteCategoryTermMutationResolverTrait;
/** @internal */
class DeleteGenericCategoryTermMutationResolver extends \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use DeleteCategoryTermMutationResolverTrait;
}
