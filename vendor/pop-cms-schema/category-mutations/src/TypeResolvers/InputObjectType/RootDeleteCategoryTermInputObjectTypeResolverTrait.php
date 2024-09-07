<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
trait RootDeleteCategoryTermInputObjectTypeResolverTrait
{
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
