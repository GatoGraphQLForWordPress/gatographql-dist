<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractUpdateEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractUpdateCommentMetaInputObjectTypeResolver extends AbstractUpdateEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\UpdateCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a comment\'s meta', 'commentmeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the comment', 'commentmeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
