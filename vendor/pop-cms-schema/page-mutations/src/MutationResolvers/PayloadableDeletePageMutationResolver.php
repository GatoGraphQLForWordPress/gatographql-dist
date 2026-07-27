<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteCustomPostMutationResolverTrait;
/** @internal */
class PayloadableDeletePageMutationResolver extends \PoPCMSSchema\PageMutations\MutationResolvers\DeletePageMutationResolver
{
    use PayloadableDeleteCustomPostMutationResolverTrait;
}
