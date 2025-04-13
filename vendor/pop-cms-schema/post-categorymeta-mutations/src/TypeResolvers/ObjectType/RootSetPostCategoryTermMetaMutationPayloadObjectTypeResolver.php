<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\AbstractPostCategoryMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetPostCategoryTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a set meta mutation on a post\'s category term', 'category-mutations');
    }
}
