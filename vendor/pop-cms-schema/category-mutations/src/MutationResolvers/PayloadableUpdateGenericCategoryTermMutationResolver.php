<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableUpdateCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableUpdateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use PayloadableUpdateCategoryTermMutationResolverTrait;
}
