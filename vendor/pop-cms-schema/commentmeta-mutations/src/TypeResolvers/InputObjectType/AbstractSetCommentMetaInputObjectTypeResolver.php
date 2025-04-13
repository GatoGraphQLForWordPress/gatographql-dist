<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractSetEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractSetCommentMetaInputObjectTypeResolver extends AbstractSetEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\SetCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set entries on a comment', 'commentmeta-mutations');
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
