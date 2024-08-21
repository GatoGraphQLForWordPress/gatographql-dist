<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateTagTermMutationResolverTrait;
/** @internal */
class PayloadableCreateGenericTagTermMutationResolver extends \PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableCreateTagTermMutationResolverTrait;
}
