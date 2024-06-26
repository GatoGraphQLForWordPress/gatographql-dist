<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
/** @internal */
class PageContentAsOneofInputObjectTypeResolver extends AbstractCustomPostContentAsOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PageContentInput';
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::HTML:
                return $this->__('Use HTML as content for the page', 'custompost-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
