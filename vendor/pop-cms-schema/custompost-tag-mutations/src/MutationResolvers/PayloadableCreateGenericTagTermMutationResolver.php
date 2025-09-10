<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateTagTermMutationResolverTrait;
/** @internal */
class PayloadableCreateGenericTagTermMutationResolver extends \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableCreateTagTermMutationResolverTrait;
}
