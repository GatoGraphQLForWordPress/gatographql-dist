<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootCreateTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootCreatePostTagTermInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\CreatePostTagTermInputObjectTypeResolverInterface
{
    use RootCreateTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreatePostTagInput';
    }
}
