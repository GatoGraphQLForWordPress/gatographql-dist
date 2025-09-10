<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class TagTermDeleteMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\DeleteTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'TagDeleteMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
