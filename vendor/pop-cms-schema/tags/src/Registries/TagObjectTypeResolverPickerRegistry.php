<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\Registries;

use PoPCMSSchema\Tags\ObjectTypeResolverPickers\TagObjectTypeResolverPickerInterface;
class TagObjectTypeResolverPickerRegistry implements \PoPCMSSchema\Tags\Registries\TagObjectTypeResolverPickerRegistryInterface
{
    /**
     * @var TagObjectTypeResolverPickerInterface[]
     */
    protected $tagObjectTypeResolverPickers = [];
    public function addTagObjectTypeResolverPicker(TagObjectTypeResolverPickerInterface $tagObjectTypeResolverPicker) : void
    {
        $this->tagObjectTypeResolverPickers[] = $tagObjectTypeResolverPicker;
    }
    /**
     * @return TagObjectTypeResolverPickerInterface[]
     */
    public function getTagObjectTypeResolverPickers() : array
    {
        return $this->tagObjectTypeResolverPickers;
    }
}
