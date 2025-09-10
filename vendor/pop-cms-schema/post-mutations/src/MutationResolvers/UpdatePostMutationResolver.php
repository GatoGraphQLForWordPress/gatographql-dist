<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;
/** @internal */
class UpdatePostMutationResolver extends \PoPCMSSchema\PostMutations\MutationResolvers\AbstractCreateOrUpdatePostMutationResolver
{
    use UpdateCustomPostMutationResolverTrait;
}
