<?php

declare (strict_types=1);
namespace PoP\RootWP\Hooks;

use PrefixedByPoP\Brain\Cortex\Route\QueryRoute;
use PrefixedByPoP\Brain\Cortex\Route\RouteCollectionInterface;
use PrefixedByPoP\Brain\Cortex\Route\RouteInterface;
use PoP\RootWP\Routing\WPQueries;
use PoP\RootWP\Routing\WPQueryRoutingManagerInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use PoP\Root\Module;
use PoP\Root\ModuleConfiguration;
use PoP\Root\Routing\RoutingManagerInterface;
class SetupCortexRoutingHookSet extends AbstractHookSet
{
    /**
     * @var \PoP\Root\Routing\RoutingManagerInterface|null
     */
    private $routingManager;
    public final function setRoutingManager(RoutingManagerInterface $routingManager) : void
    {
        $this->routingManager = $routingManager;
    }
    protected final function getRoutingManager() : RoutingManagerInterface
    {
        if ($this->routingManager === null) {
            /** @var RoutingManagerInterface */
            $routingManager = $this->instanceManager->getInstance(RoutingManagerInterface::class);
            $this->routingManager = $routingManager;
        }
        return $this->routingManager;
    }
    protected function init() : void
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if (!$moduleConfiguration->enablePassingRoutingStateViaRequest()) {
            return;
        }
        \PrefixedByPoP\add_action('cortex.routes', \Closure::fromCallable([$this, 'setupCortex']), 1);
    }
    /**
     * @param RouteCollectionInterface<RouteInterface> $routes
     */
    public function setupCortex(RouteCollectionInterface $routes) : void
    {
        /** @var WPQueryRoutingManagerInterface */
        $routingManager = $this->getRoutingManager();
        foreach ($routingManager->getRoutes() as $route) {
            $routes->addRoute(new QueryRoute($route, function (array $matches) {
                return WPQueries::GENERIC_NATURE;
            }));
        }
    }
}
