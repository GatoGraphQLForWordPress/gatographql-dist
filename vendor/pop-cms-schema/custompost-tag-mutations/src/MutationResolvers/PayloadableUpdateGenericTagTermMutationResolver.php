<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateTagTermMutationResolverTrait;
/** @internal */
class PayloadableUpdateGenericTagTermMutationResolver extends \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableUpdateTagTermMutationResolverTrait;
}
