<?php

declare (strict_types=1);
namespace PoP\Engine\Hooks;

use PoP\Root\App;
use PoP\ComponentModel\ModelInstance\ModelInstance;
use PoP\Engine\Module;
use PoP\Engine\ModuleConfiguration;
use PoP\Root\Hooks\AbstractHookSet;
/** @internal */
class VarsHookSet extends AbstractHookSet
{
    protected function init() : void
    {
        App::addFilter(ModelInstance::HOOK_ELEMENTS_RESULT, \Closure::fromCallable([$this, 'getModelInstanceElementsFromAppState']));
    }
    /**
     * @return string[]
     * @param string[] $elements
     */
    public function getModelInstanceElementsFromAppState(array $elements) : array
    {
        // Removing fields changes the configuration
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $elements[] = $this->__('disable redundant root fields:', 'pop-engine') . $moduleConfiguration->disableRedundantRootTypeMutationFields();
        return $elements;
    }
}
