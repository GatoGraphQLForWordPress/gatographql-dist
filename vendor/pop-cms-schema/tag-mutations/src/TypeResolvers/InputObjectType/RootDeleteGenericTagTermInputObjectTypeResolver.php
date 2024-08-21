<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractDeleteGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\DeleteTagTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericTagInput';
    }
    protected function addTaxonomyInputField() : bool
    {
        return \true;
    }
}
