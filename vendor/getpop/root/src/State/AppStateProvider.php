<?php

declare (strict_types=1);
namespace PoP\Root\State;

use PoP\Root\App;
use PoP\Root\Module;
use PoP\Root\ModuleConfiguration;
use PoP\Root\Routing\RequestNature;
use PoP\Root\Routing\RoutingManagerInterface;
/** @internal */
class AppStateProvider extends \PoP\Root\State\AbstractAppStateProvider
{
    /**
     * @var \PoP\Root\Routing\RoutingManagerInterface|null
     */
    private $routingManager;
    protected final function getRoutingManager() : RoutingManagerInterface
    {
        if ($this->routingManager === null) {
            /** @var RoutingManagerInterface */
            $routingManager = $this->instanceManager->getInstance(RoutingManagerInterface::class);
            $this->routingManager = $routingManager;
        }
        return $this->routingManager;
    }
    /**
     * @param array<string,mixed> $state
     */
    public function initialize(array &$state) : void
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->enablePassingRoutingStateViaRequest()) {
            $state['nature'] = $this->getRoutingManager()->getCurrentRequestNature();
            $state['route'] = $this->getRoutingManager()->getCurrentRoute();
        } else {
            $state['nature'] = RequestNature::GENERIC;
            $state['route'] = '';
        }
        $state['routing'] = [];
    }
    /**
     * @param array<string,mixed> $state
     */
    public function augment(array &$state) : void
    {
        $nature = $state['nature'];
        $state['routing']['is-generic'] = $nature === RequestNature::GENERIC;
        $state['routing']['is-home'] = $nature === RequestNature::HOME;
        $state['routing']['is-404'] = $nature === RequestNature::NOTFOUND;
    }
}
