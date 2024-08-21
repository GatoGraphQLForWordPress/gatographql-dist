<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\AbstractCategoryMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CategoryTermDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CategoryMutations\ObjectTypeResolverPickers\AbstractCategoryTermDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCategoryMutationErrorPayloadUnionTypeResolver::class];
    }
}
