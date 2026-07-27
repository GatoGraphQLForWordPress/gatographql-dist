<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\AbstractUpdateUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\UserMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUpdateUserMutationErrorPayloadUnionTypeResolver::class];
    }
}
