<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

/** @internal */
class PayloadableDeleteUserMutationResolver extends \PoPCMSSchema\UserMutations\MutationResolvers\DeleteUserMutationResolver
{
    use \PoPCMSSchema\UserMutations\MutationResolvers\PayloadableDeleteUserMutationResolverTrait;
}
