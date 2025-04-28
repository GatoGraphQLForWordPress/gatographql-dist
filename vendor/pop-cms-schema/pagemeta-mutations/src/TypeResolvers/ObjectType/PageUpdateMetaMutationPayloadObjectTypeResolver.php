<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class PageUpdateMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\AbstractPageMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PageUpdateMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta nested mutation on a page', 'pagemeta-mutations');
    }
}
