<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait;
/** @internal */
class DeletePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use DeleteTagTermMutationResolverTrait;
}
