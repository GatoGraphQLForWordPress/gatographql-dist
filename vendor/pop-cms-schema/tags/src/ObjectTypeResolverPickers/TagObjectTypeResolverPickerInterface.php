<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\ObjectTypeResolverPickers;

use PoP\ComponentModel\ObjectTypeResolverPickers\ObjectTypeResolverPickerInterface;
/** @internal */
interface TagObjectTypeResolverPickerInterface extends ObjectTypeResolverPickerInterface
{
    public function getTagTaxonomy() : string;
}
