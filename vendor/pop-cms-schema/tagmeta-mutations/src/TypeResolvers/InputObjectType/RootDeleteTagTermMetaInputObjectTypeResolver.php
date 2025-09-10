<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteTagTermMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\DeleteTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteTagMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
