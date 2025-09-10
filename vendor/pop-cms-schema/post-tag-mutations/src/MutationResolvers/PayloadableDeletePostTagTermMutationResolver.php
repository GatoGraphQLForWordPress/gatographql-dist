<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableDeleteTagTermMutationResolverTrait;
/** @internal */
class PayloadableDeletePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use PayloadableDeleteTagTermMutationResolverTrait;
}
