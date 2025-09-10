<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\UpdateTagTermMutationResolverTrait;
/** @internal */
class UpdatePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use UpdateTagTermMutationResolverTrait;
}
