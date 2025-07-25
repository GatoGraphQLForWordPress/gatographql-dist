<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootSetPageMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\AbstractPageMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetPageMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a set meta mutation on a page', 'pagemeta-mutations');
    }
}
