<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\ObjectTypeResolverPickers;

use PoPCMSSchema\Tags\TypeResolvers\UnionType\TagUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class TagUnionGenericTagObjectTypeResolverPicker extends \PoPCMSSchema\Tags\ObjectTypeResolverPickers\AbstractGenericTagObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [TagUnionTypeResolver::class];
    }
}
