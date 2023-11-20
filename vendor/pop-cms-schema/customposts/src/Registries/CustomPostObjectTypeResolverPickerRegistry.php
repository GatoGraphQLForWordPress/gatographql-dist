<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\Registries;

use PoPCMSSchema\CustomPosts\ObjectTypeResolverPickers\CustomPostObjectTypeResolverPickerInterface;
/** @internal */
class CustomPostObjectTypeResolverPickerRegistry implements \PoPCMSSchema\CustomPosts\Registries\CustomPostObjectTypeResolverPickerRegistryInterface
{
    /**
     * @var CustomPostObjectTypeResolverPickerInterface[]
     */
    protected $customPostObjectTypeResolverPickers = [];
    public function addCustomPostObjectTypeResolverPicker(CustomPostObjectTypeResolverPickerInterface $customPostObjectTypeResolverPicker) : void
    {
        $this->customPostObjectTypeResolverPickers[] = $customPostObjectTypeResolverPicker;
    }
    /**
     * @return CustomPostObjectTypeResolverPickerInterface[]
     */
    public function getCustomPostObjectTypeResolverPickers() : array
    {
        return $this->customPostObjectTypeResolverPickers;
    }
}
