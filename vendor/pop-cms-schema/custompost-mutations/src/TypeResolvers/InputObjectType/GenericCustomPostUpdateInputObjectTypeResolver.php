<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericCustomPostUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostUpdateInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateGenericCustomPostInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostUpdateInput';
    }
    protected function addCustomPostParentInputField() : bool
    {
        return \true;
    }
}
