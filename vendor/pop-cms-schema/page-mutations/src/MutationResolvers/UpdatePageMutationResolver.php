<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;
/** @internal */
class UpdatePageMutationResolver extends \PoPCMSSchema\PageMutations\MutationResolvers\AbstractCreateOrUpdatePageMutationResolver
{
    use UpdateCustomPostMutationResolverTrait;
}
