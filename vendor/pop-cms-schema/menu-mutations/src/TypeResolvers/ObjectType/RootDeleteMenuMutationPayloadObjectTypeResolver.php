<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteMenuMutationPayloadObjectTypeResolver extends \PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType\AbstractMenuMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteMenuMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of deleting a menu', 'gatographql');
    }
}
