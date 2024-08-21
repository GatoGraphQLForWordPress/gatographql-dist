<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootDeleteTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootDeletePostTagTermInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractDeletePostTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\DeletePostTagTermInputObjectTypeResolverInterface
{
    use RootDeleteTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeletePostTagInput';
    }
}
