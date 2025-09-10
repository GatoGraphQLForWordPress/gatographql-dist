<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateCustomPostMutationResolverTrait;
/** @internal */
class PayloadableCreatePostMutationResolver extends \PoPCMSSchema\PostMutations\MutationResolvers\AbstractCreateOrUpdatePostMutationResolver
{
    use PayloadableCreateCustomPostMutationResolverTrait;
}
