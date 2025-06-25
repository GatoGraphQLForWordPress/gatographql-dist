<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateGenericCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCustomPostInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CreateCustomPostInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootCreateCustomPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
    protected function isCustomPostTypeFieldMandatory() : bool
    {
        return \true;
    }
}
