<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateTagTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateGenericTagInput';
    }
    protected function addTaxonomyInputField() : bool
    {
        return \true;
    }
    protected function isNameInputFieldMandatory() : bool
    {
        return \false;
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
