<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateCategoryTermMutationResolverTrait;
/** @internal */
class UpdateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use UpdateCategoryTermMutationResolverTrait;
}
