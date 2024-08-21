<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class TagTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateTagTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'TagUpdateInput';
    }
}
