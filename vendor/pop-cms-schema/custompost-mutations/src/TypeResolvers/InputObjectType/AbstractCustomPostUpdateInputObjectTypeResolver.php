<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
abstract class AbstractCustomPostUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateCustomPostInputObjectTypeResolverInterface
{
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
