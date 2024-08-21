<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

/** @internal */
class UpdateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use \PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateCategoryTermMutationResolverTrait;
}
