<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateCustomPostMutationResolverTrait;
/** @internal */
class PayloadableCreatePageMutationResolver extends \PoPCMSSchema\PageMutations\MutationResolvers\AbstractCreateOrUpdatePageMutationResolver
{
    use PayloadableCreateCustomPostMutationResolverTrait;
}
