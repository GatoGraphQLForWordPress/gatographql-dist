<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
class PostContentAsOneofInputObjectTypeResolver extends AbstractCustomPostContentAsOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostContentInput';
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::HTML:
                return $this->__('Use HTML as content for the post', 'custompost-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
