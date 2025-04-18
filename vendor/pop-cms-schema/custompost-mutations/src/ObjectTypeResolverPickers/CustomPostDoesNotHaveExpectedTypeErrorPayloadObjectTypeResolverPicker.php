<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CustomPostDoesNotHaveExpectedTypeErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers\AbstractCustomPostDoesNotHaveExpectedTypeErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver::class];
    }
}
