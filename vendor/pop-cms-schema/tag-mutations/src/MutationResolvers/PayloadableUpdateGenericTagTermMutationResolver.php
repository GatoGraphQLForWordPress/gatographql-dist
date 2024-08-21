<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateTagTermMutationResolverTrait;
/** @internal */
class PayloadableUpdateGenericTagTermMutationResolver extends \PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableUpdateTagTermMutationResolverTrait;
}
