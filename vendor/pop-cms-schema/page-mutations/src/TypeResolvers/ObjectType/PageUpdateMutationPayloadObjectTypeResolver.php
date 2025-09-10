<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\ObjectType;

/** @internal */
class PageUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\AbstractPageMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PageUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a page', 'page-mutations');
    }
}
