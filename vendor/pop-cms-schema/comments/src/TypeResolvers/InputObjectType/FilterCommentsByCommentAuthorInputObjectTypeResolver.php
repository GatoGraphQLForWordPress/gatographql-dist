<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\TypeResolvers\InputObjectType;

/** @internal */
class FilterCommentsByCommentAuthorInputObjectTypeResolver extends \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\AbstractFilterCommentsByAuthorInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'FilterCommentsByCommentAuthorInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Filter comments by comment author', 'comments');
    }
    protected function getAuthorIDsFilteringQueryArgName() : string
    {
        return 'author-ids';
    }
    protected function getExcludeAuthorIDsFilteringQueryArgName() : string
    {
        return 'exclude-author-ids';
    }
}
