<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
trait TagTermUpdateInputObjectTypeResolverTrait
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a tag term', 'tag-mutations');
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
    protected function isNameInputFieldMandatory() : bool
    {
        return \false;
    }
}
