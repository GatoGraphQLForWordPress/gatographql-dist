<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\CustomPostAddCommentMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\RootReplyCommentMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers\AbstractCommentParentCommentDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver::class, RootReplyCommentMutationErrorPayloadUnionTypeResolver::class, CustomPostAddCommentMutationErrorPayloadUnionTypeResolver::class];
    }
}
