<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;
/** @internal */
class CreatePageMutationResolver extends \PoPCMSSchema\PageMutations\MutationResolvers\AbstractCreateUpdatePageMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
