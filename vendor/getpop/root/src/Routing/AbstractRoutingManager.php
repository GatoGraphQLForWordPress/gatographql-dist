<?php

declare (strict_types=1);
namespace PoP\Root\Routing;

use PoP\Root\Configuration\Request;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractRoutingManager extends AbstractBasicService implements \PoP\Root\Routing\RoutingManagerInterface
{
    /**
     * @var \PoP\Root\Routing\RoutingHelperServiceInterface|null
     */
    private $routingHelperService;
    protected final function getRoutingHelperService() : \PoP\Root\Routing\RoutingHelperServiceInterface
    {
        if ($this->routingHelperService === null) {
            /** @var RoutingHelperServiceInterface */
            $routingHelperService = $this->instanceManager->getInstance(\PoP\Root\Routing\RoutingHelperServiceInterface::class);
            $this->routingHelperService = $routingHelperService;
        }
        return $this->routingHelperService;
    }
    /**
     * By default, everything is a generic route
     */
    public function getCurrentRequestNature() : string
    {
        return \PoP\Root\Routing\RequestNature::GENERIC;
    }
    public function getCurrentRoute() : string
    {
        $nature = $this->getCurrentRequestNature();
        // By default, use the "main" route
        $default = \PoP\Root\Routing\Routes::MAIN;
        // If it is a GENERIC route, then the URL path is already the route
        if ($nature === \PoP\Root\Routing\RequestNature::GENERIC) {
            $requestURIPath = $this->getRoutingHelperService()->getRequestURIPath();
            if ($requestURIPath === null) {
                return $default;
            }
            return $requestURIPath;
        }
        // If having set URL param "route", then use it
        $route = Request::getRoute();
        if ($route !== null) {
            return $route;
        }
        return $default;
    }
}
