<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericCustomPostUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostUpdateInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateGenericCustomPostInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostUpdateInput';
    }
}
