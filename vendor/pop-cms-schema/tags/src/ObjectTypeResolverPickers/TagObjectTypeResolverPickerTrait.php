<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\ObjectTypeResolverPickers;

use PoPCMSSchema\Tags\Module;
use PoPCMSSchema\Tags\ModuleConfiguration;
use PoP\ComponentModel\App;
/** @internal */
trait TagObjectTypeResolverPickerTrait
{
    /**
     * @return string[]
     */
    public abstract function getTagTaxonomies() : array;
    public function isServiceEnabled() : bool
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return \array_intersect($this->getTagTaxonomies(), $moduleConfiguration->getQueryableTagTaxonomies()) !== [];
    }
}
