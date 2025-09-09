<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeAPIs;

use PoP\Root\Services\AbstractBasicService;
use PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface;
/** @internal */
abstract class AbstractUserTypeAPI extends AbstractBasicService implements \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface
{
    private ?CMSHelperServiceInterface $cmsHelperService = null;
    protected final function getCMSHelperService() : CMSHelperServiceInterface
    {
        if ($this->cmsHelperService === null) {
            /** @var CMSHelperServiceInterface */
            $cmsHelperService = $this->instanceManager->getInstance(CMSHelperServiceInterface::class);
            $this->cmsHelperService = $cmsHelperService;
        }
        return $this->cmsHelperService;
    }
    public function getUserURLPath(string|int|object $userObjectOrID) : ?string
    {
        $userURL = $this->getUserURL($userObjectOrID);
        if ($userURL === null) {
            return null;
        }
        return $this->getCMSHelperService()->getLocalURLPath($userURL);
    }
}
