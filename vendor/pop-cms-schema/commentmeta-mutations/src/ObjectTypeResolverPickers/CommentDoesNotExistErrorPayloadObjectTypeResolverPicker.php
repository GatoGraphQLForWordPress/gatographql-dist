<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers\AbstractCommentDoesNotExistErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\AbstractRootCommentMetaMutationErrorPayloadUnionTypeResolver;
/** @internal */
class CommentDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractCommentDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractRootCommentMetaMutationErrorPayloadUnionTypeResolver::class];
    }
}
