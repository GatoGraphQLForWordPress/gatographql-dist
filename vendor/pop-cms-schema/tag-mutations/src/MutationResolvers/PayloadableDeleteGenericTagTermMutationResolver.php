<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableDeleteTagTermMutationResolverTrait;
/** @internal */
class PayloadableDeleteGenericTagTermMutationResolver extends \PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableDeleteTagTermMutationResolverTrait;
}
