<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeAPIs;

use PoP\Root\Services\BasicServiceTrait;
use PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface;
/** @internal */
abstract class AbstractCustomPostTypeAPI implements \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface|null
     */
    private $cmsHelperService;
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
     * @param string|int|object $customPostObjectOrID
     */
    public function getPermalinkPath($customPostObjectOrID) : ?string
    {
        $permalink = $this->getPermalink($customPostObjectOrID);
        if ($permalink === null) {
            return null;
        }
        return $this->getCMSHelperService()->getLocalURLPath($permalink);
    }
}
