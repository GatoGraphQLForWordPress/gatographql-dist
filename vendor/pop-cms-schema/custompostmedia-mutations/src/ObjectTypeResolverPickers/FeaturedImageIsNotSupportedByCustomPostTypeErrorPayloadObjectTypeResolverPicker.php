<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\AbstractCustomPostMediaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CustomPostMediaMutations\ObjectTypeResolverPickers\AbstractFeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCustomPostMediaMutationErrorPayloadUnionTypeResolver::class];
    }
}
