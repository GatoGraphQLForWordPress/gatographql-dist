<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\Hooks;

use PoP\ComponentModel\HelperServices\RequestHelperServiceInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use PoP\Root\Routing\HookNames;
use PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface;
use PoPCMSSchema\SchemaCommons\Module;
use PoPCMSSchema\SchemaCommons\ModuleConfiguration;
/** @internal */
class RoutingHookSet extends AbstractHookSet
{
    /**
     * @var \PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface|null
     */
    private $cmsService;
    /**
     * @var \PoP\ComponentModel\HelperServices\RequestHelperServiceInterface|null
     */
    private $requestHelperService;
    protected final function getCMSService() : CMSServiceInterface
    {
        if ($this->cmsService === null) {
            /** @var CMSServiceInterface */
            $cmsService = $this->instanceManager->getInstance(CMSServiceInterface::class);
            $this->cmsService = $cmsService;
        }
        return $this->cmsService;
    }
    protected final function getRequestHelperService() : RequestHelperServiceInterface
    {
        if ($this->requestHelperService === null) {
            /** @var RequestHelperServiceInterface */
            $requestHelperService = $this->instanceManager->getInstance(RequestHelperServiceInterface::class);
            $this->requestHelperService = $requestHelperService;
        }
        return $this->requestHelperService;
    }
    protected function init() : void
    {
        App::addFilter(HookNames::REQUEST_URI, \Closure::fromCallable([$this, 'maybeOverrideURIRoute']));
    }
    /**
     * Replace REQUEST_URI with the website's home URL.
     *
     * Watch out: If the homeURL is not contained in the current URL,
     * then there's a misconfiguration in the server.
     *
     * This logic will remove the language information from a Multisite
     * network based on subfolders (https://domain.com/en/...)
     */
    public function maybeOverrideURIRoute(string $route) : string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if (!$moduleConfiguration->overrideRequestURI()) {
            return $route;
        }
        $currentURL = $this->getRequestHelperService()->getComponentModelCurrentURL();
        if ($currentURL === null) {
            return $route;
        }
        $homeURL = $this->getCMSService()->getHomeURL();
        // Remove the protocol to avoid erroring on http/https
        /** @var string */
        $homeURL = \preg_replace('#^https?://#', '', $homeURL);
        /** @var string */
        $currentURL = \preg_replace('#^https?://#', '', $currentURL);
        if (\substr($currentURL, 0, \strlen($homeURL)) !== $homeURL) {
            // This is too harsh. Just ignore hook
            // throw new GenericSystemException(sprintf(
            //     'The webserver is not configured properly, since the current URL \'%s\' does not contain the home URL \'%s\' (possibly the server name has not been set-up correctly)',
            //     $currentURL,
            //     $homeURL
            // ));
            return $route;
        }
        return \substr($currentURL, \strlen($homeURL));
    }
}
