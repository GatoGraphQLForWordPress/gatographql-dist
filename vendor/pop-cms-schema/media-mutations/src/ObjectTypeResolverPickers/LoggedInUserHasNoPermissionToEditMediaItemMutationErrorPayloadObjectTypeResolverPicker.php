<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractUpdateMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditMediaItemMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPermissionToEditMediaItemMutationErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUpdateMediaItemMutationErrorPayloadUnionTypeResolver::class];
    }
}
