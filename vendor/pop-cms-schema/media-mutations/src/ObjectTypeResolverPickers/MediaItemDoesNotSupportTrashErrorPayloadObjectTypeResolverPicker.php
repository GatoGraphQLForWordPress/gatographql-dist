<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractDeleteMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class MediaItemDoesNotSupportTrashErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers\AbstractMediaItemDoesNotSupportTrashErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractDeleteMediaItemMutationErrorPayloadUnionTypeResolver::class];
    }
}
