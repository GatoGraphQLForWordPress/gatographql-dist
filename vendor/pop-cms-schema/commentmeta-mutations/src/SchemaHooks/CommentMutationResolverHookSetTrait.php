<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\SchemaHooks;

use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\AddCommentToCustomPostInputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
/** @internal */
trait CommentMutationResolverHookSetTrait
{
    protected function isInputObjectTypeResolver(InputObjectTypeResolverInterface $inputObjectTypeResolver) : bool
    {
        return $inputObjectTypeResolver instanceof AddCommentToCustomPostInputObjectTypeResolverInterface;
    }
}
