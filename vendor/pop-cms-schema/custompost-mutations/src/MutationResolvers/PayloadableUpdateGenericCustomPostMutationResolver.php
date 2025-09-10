<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateCustomPostMutationResolverTrait;
/** @internal */
class PayloadableUpdateGenericCustomPostMutationResolver extends \PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateGenericCustomPostMutationResolver
{
    use PayloadableUpdateCustomPostMutationResolverTrait;
}
