<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\AbstractUpdateCommentMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditCommentErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPermissionToEditCommentErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUpdateCommentMutationErrorPayloadUnionTypeResolver::class];
    }
}
