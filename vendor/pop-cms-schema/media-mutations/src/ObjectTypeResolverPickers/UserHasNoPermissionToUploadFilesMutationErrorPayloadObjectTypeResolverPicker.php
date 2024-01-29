<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserHasNoPermissionToUploadFilesMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers\AbstractUserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver::class];
    }
}
