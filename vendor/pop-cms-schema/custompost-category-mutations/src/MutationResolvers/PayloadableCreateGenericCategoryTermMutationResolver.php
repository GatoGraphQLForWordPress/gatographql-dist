<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableCreateCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableCreateGenericCategoryTermMutationResolver extends \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use PayloadableCreateCategoryTermMutationResolverTrait;
}
