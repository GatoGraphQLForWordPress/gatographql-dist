<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableDeleteTagTermMutationResolverTrait;
/** @internal */
class PayloadableDeleteGenericTagTermMutationResolver extends \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use PayloadableDeleteTagTermMutationResolverTrait;
}
