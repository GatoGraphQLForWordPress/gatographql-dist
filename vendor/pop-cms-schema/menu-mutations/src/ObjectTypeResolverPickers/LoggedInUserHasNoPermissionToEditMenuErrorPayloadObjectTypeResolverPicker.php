<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\AbstractUpdateMenuMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MenuMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUpdateMenuMutationErrorPayloadUnionTypeResolver::class];
    }
}
