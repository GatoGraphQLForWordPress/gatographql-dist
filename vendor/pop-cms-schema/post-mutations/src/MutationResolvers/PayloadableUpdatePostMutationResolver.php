<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateCustomPostMutationResolverTrait;
/** @internal */
class PayloadableUpdatePostMutationResolver extends \PoPCMSSchema\PostMutations\MutationResolvers\AbstractCreateOrUpdatePostMutationResolver
{
    use PayloadableUpdateCustomPostMutationResolverTrait;
}
