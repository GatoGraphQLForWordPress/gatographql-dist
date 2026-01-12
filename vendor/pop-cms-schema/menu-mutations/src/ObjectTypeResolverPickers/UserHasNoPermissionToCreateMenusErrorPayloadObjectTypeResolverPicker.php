<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\AbstractCreateMenuMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserHasNoPermissionToCreateMenusErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MenuMutations\ObjectTypeResolverPickers\AbstractUserHasNoPermissionToCreateMenusErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCreateMenuMutationErrorPayloadUnionTypeResolver::class];
    }
}
