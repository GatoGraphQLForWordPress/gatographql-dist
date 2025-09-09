<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType;

/** @internal */
class WithParentCustomPostChildrenFilterInputObjectTypeResolver extends \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractWithParentCustomPostsFilterInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'WithParentCustomPostChildrenFilterInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to filter the custom post children', 'pages');
    }
    protected function addParentInputFields() : bool
    {
        return \false;
    }
}
