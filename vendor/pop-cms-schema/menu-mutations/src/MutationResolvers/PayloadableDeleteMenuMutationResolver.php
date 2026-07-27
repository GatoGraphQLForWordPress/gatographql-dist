<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

/** @internal */
class PayloadableDeleteMenuMutationResolver extends \PoPCMSSchema\MenuMutations\MutationResolvers\DeleteMenuMutationResolver
{
    use \PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableDeleteMenuMutationResolverTrait;
}
