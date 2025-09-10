<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\MutationResolvers\PayloadableDeleteCategoryTermMutationResolverTrait;
/** @internal */
class PayloadableDeleteGenericCategoryTermMutationResolver extends \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\AbstractMutateGenericCategoryTermMutationResolver
{
    use PayloadableDeleteCategoryTermMutationResolverTrait;
}
