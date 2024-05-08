<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateCustomPostMutationResolverTrait;
/** @internal */
class PayloadableCreateGenericCustomPostMutationResolver extends \PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateUpdateGenericCustomPostMutationResolver
{
    use PayloadableCreateCustomPostMutationResolverTrait;
}
