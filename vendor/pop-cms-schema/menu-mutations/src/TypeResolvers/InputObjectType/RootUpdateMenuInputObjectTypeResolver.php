<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateMenuInputObjectTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\InputObjectType\AbstractUpdateMenuInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateMenuInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a menu', 'menu-mutations');
    }
}
