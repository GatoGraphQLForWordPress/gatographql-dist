<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
trait CategoryTermDeleteInputObjectTypeResolverTrait
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete the meta for a category term', 'category-mutations');
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
