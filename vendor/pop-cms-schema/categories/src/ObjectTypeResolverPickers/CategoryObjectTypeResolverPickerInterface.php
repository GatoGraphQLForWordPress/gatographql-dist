<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\ObjectTypeResolverPickers;

use PoP\ComponentModel\ObjectTypeResolverPickers\ObjectTypeResolverPickerInterface;
/** @internal */
interface CategoryObjectTypeResolverPickerInterface extends ObjectTypeResolverPickerInterface
{
    public function getCategoryTaxonomy() : string;
}
