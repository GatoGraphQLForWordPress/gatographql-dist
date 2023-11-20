<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ConditionalOnModule\Users\Overrides\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\ConditionalOnModule\Users\FieldResolvers\ObjectType\AbstractAddCommentToCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CommentMutations\FieldResolvers\ObjectType\GenericCustomPostObjectTypeFieldResolverTrait;
/** @internal */
class GenericCustomPostObjectTypeFieldResolver extends AbstractAddCommentToCustomPostObjectTypeFieldResolver
{
    use GenericCustomPostObjectTypeFieldResolverTrait;
}
