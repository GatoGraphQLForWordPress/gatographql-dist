<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeAPIs;

use PoP\Root\Services\BasicServiceTrait;
use PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface;
/** @internal */
abstract class AbstractUserTypeAPI implements \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface|null
     */
    private $cmsHelperService;
    public final function setCMSHelperService(CMSHelperServiceInterface $cmsHelperService) : void
    {
        $this->cmsHelperService = $cmsHelperService;
    }
    protected final function getCMSHelperService() : CMSHelperServiceInterface
    {
        if ($this->cmsHelperService === null) {
            /** @var CMSHelperServiceInterface */
            $cmsHelperService = $this->instanceManager->getInstance(CMSHelperServiceInterface::class);
            $this->cmsHelperService = $cmsHelperService;
        }
        return $this->cmsHelperService;
    }
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserURLPath($userObjectOrID) : ?string
    {
        $userURL = $this->getUserURL($userObjectOrID);
        if ($userURL === null) {
            return null;
        }
        return $this->getCMSHelperService()->getLocalURLPath($userURL);
    }
}
