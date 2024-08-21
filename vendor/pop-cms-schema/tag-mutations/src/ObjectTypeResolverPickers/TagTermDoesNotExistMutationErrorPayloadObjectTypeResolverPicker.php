<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractTagMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class TagTermDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\TagMutations\ObjectTypeResolverPickers\AbstractTagTermDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractTagMutationErrorPayloadUnionTypeResolver::class];
    }
}
