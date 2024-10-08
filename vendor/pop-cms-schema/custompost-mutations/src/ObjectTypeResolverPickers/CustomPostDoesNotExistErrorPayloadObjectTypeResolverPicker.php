<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers\AbstractCustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver::class];
    }
}
