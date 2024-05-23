<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreatePageMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\AbstractPageMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreatePageMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a page', 'page-mutations');
    }
}
