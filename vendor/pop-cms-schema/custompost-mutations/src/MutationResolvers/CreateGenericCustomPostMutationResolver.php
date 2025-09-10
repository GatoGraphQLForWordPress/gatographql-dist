<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;
/** @internal */
class CreateGenericCustomPostMutationResolver extends \PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateGenericCustomPostMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
