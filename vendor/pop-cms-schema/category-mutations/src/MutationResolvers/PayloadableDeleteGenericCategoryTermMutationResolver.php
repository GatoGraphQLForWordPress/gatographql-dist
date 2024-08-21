<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableDeleteCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableDeleteGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use PayloadableDeleteCategoryTermMutationResolverTrait;
}