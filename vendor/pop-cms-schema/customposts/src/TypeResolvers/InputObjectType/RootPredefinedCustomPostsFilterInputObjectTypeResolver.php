<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType;

/** @internal */
class RootPredefinedCustomPostsFilterInputObjectTypeResolver extends \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractCustomPostsFilterInputObjectTypeResolver implements \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostsFilterInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootPredefinedCustomPostsFilterInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to filter predefined custom posts', 'customposts');
    }
}
