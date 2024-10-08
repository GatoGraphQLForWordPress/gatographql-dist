<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
trait RootCreateCategoryTermInputObjectTypeResolverTrait
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to create a category term', 'category-mutations');
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
    protected function isNameInputFieldMandatory() : bool
    {
        return \true;
    }
}
