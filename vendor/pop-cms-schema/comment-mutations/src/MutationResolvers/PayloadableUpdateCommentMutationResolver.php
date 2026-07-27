<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

/** @internal */
class PayloadableUpdateCommentMutationResolver extends \PoPCMSSchema\CommentMutations\MutationResolvers\UpdateCommentMutationResolver
{
    use \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableUpdateCommentMutationResolverTrait;
}
