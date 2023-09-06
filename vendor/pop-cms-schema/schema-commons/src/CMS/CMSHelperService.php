<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\CMS;

use PoP\ComponentModel\Misc\GeneralUtils;
use PoP\Root\Services\BasicServiceTrait;
class CMSHelperService implements \PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface|null
     */
    private $cmsService;
    public final function setCMSService(\PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface $cmsService) : void
    {
        $this->cmsService = $cmsService;
    }
    protected final function getCMSService() : \PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface
    {
        if ($this->cmsService === null) {
            /** @var CMSServiceInterface */
            $cmsService = $this->instanceManager->getInstance(\PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface::class);
            $this->cmsService = $cmsService;
        }
        return $this->cmsService;
    }
    public function getLocalURLPath(string $url) : ?string
    {
        if (\strncmp($url, $this->getCMSService()->getHomeURL(), \strlen($this->getCMSService()->getHomeURL())) === 0) {
            return GeneralUtils::getPath($url);
        }
        return null;
    }
    /**
     * Indicate if the URL belongs to the current domain,
     * whether http or https
     */
    public function isCurrentDomain(string $url) : bool
    {
        $homeURL = $this->getCMSService()->getHomeURL();
        return GeneralUtils::getHost($url) === GeneralUtils::getHost($homeURL);
    }
}
