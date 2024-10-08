<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ConditionalOnModule\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers\AbstractCustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker;
use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractCustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver::class];
    }
}
