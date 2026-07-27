<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

/** @internal */
class PayloadableDeleteCommentMutationResolver extends \PoPCMSSchema\CommentMutations\MutationResolvers\DeleteCommentMutationResolver
{
    use \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableDeleteCommentMutationResolverTrait;
}
