<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericTagTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateGenericTagTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'GenericTagUpdateInput';
    }
}
