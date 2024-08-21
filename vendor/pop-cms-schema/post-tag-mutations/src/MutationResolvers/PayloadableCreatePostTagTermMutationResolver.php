<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateTagTermMutationResolverTrait;
/** @internal */
class PayloadableCreatePostTagTermMutationResolver extends \PoPCMSSchema\PostTagMutations\MutationResolvers\AbstractMutatePostTagTermMutationResolver
{
    use PayloadableCreateTagTermMutationResolverTrait;
}
