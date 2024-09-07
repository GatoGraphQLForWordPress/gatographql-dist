<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers\AbstractUserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver::class];
    }
}
