<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteMenuInputObjectTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\InputObjectType\AbstractDeleteMenuInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteMenuInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a menu', 'gatographql');
    }
}
