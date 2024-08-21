<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\ObjectTypeResolverPickers;

use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CategoryDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CategoryMutations\ObjectTypeResolverPickers\AbstractCategoryDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [];
    }
}
