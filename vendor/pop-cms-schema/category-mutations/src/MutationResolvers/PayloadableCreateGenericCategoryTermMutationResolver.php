<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableCreateCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableCreateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use PayloadableCreateCategoryTermMutationResolverTrait;
}
