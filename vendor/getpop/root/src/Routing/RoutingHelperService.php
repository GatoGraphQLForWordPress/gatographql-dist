<?php

declare (strict_types=1);
namespace PoP\Root\Routing;

use PoP\Root\App;
use PoP\Root\Services\BasicServiceTrait;
/** @internal */
class RoutingHelperService implements \PoP\Root\Routing\RoutingHelperServiceInterface
{
    use BasicServiceTrait;
    /**
     * @var bool
     */
    private $requestURIInitialized = \false;
    /**
     * @var string|null
     */
    private $requestURI;
    public function getRequestURI() : ?string
    {
        if ($this->requestURIInitialized) {
            return $this->requestURI;
        }
        $this->requestURIInitialized = \true;
        if (!App::isHTTPRequest()) {
            $this->requestURI = null;
            return $this->requestURI;
        }
        /**
         * Allow to remove the language information from Multisite network
         * based on subfolders (https://domain.com/en/...)
         */
        $this->requestURI = App::applyFilters(\PoP\Root\Routing\HookNames::REQUEST_URI, App::server('REQUEST_URI'));
        return $this->requestURI;
    }
    public function getRequestURIPath() : ?string
    {
        $route = $this->getRequestURI();
        if ($route === null) {
            return null;
        }
        $params_pos = \strpos($route, '?');
        if ($params_pos !== \false) {
            $route = \substr($route, 0, $params_pos);
        }
        return \trim($route, '/');
    }
}
