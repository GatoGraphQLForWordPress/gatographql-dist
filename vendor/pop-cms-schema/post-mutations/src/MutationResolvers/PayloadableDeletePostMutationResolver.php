<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteCustomPostMutationResolverTrait;
/** @internal */
class PayloadableDeletePostMutationResolver extends \PoPCMSSchema\PostMutations\MutationResolvers\DeletePostMutationResolver
{
    use PayloadableDeleteCustomPostMutationResolverTrait;
}
