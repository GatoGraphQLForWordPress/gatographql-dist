<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteTagTermInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractDeleteTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\DeleteTagTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootDeleteTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeleteTagInput';
    }
}
