<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

/** @internal */
class DeleteGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use \PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteCategoryTermMutationResolverTrait;
}
