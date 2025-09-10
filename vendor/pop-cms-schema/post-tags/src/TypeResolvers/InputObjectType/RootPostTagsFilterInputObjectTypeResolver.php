<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\AbstractTagsFilterInputObjectTypeResolver;
/** @internal */
class RootPostTagsFilterInputObjectTypeResolver extends AbstractTagsFilterInputObjectTypeResolver implements \PoPCMSSchema\PostTags\TypeResolvers\InputObjectType\PostTagsFilterInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootPostTagsFilterInput';
    }
}
