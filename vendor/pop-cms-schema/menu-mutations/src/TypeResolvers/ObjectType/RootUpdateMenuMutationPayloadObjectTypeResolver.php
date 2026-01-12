<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateMenuMutationPayloadObjectTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType\AbstractMenuMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateMenuMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of updating a menu', 'menu-mutations');
    }
}
