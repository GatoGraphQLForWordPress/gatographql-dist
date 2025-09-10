<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
trait RootDeleteTagTermInputObjectTypeResolverTrait
{
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
