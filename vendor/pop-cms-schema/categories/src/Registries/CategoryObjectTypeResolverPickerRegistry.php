<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\Registries;

use PoPCMSSchema\Categories\ObjectTypeResolverPickers\CategoryObjectTypeResolverPickerInterface;
/** @internal */
class CategoryObjectTypeResolverPickerRegistry implements \PoPCMSSchema\Categories\Registries\CategoryObjectTypeResolverPickerRegistryInterface
{
    /**
     * @var CategoryObjectTypeResolverPickerInterface[]
     */
    protected $categoryObjectTypeResolverPickers = [];
    public function addCategoryObjectTypeResolverPicker(CategoryObjectTypeResolverPickerInterface $categoryObjectTypeResolverPicker) : void
    {
        $this->categoryObjectTypeResolverPickers[] = $categoryObjectTypeResolverPicker;
    }
    /**
     * @return CategoryObjectTypeResolverPickerInterface[]
     */
    public function getCategoryObjectTypeResolverPickers() : array
    {
        return $this->categoryObjectTypeResolverPickers;
    }
}
