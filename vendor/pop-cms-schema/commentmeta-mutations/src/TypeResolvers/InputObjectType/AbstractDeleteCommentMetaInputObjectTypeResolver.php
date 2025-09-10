<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractDeleteEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteCommentMetaInputObjectTypeResolver extends AbstractDeleteEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\DeleteCommentMetaInputObjectTypeResolverInterface
{
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => $this->__('The ID of the comment', 'commentmeta-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
}
