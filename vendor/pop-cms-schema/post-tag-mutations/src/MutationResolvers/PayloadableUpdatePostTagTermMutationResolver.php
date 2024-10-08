<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateTagTermMutationResolverTrait;
/** @internal */
class PayloadableUpdatePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use PayloadableUpdateTagTermMutationResolverTrait;
}
