<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateGenericCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCustomPostInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateCustomPostInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateCustomPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
    protected function isCustomPostTypeFieldMandatory() : bool
    {
        return \false;
    }
}
