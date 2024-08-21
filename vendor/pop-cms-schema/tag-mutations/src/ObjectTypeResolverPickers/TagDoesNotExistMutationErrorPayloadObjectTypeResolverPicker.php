<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\ObjectTypeResolverPickers;

use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class TagDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\TagMutations\ObjectTypeResolverPickers\AbstractTagDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [];
    }
}
