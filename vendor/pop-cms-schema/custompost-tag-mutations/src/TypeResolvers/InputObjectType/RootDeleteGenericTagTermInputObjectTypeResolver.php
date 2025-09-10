<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootDeleteTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootDeleteGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractDeleteGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\DeleteGenericTagTermInputObjectTypeResolverInterface
{
    use RootDeleteTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeleteGenericTagInput';
    }
}
