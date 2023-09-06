<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\Hooks;

use PoPCMSSchema\CustomPosts\Hooks\AbstractAddDefaultCustomPostTypeModuleConfigurationHookSet;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
class PageAddDefaultCustomPostTypeModuleConfigurationHookSet extends AbstractAddDefaultCustomPostTypeModuleConfigurationHookSet
{
    /**
     * @var \PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface|null
     */
    private $pageTypeAPI;
    public final function setPageTypeAPI(PageTypeAPIInterface $pageTypeAPI) : void
    {
        $this->pageTypeAPI = $pageTypeAPI;
    }
    protected final function getPageTypeAPI() : PageTypeAPIInterface
    {
        if ($this->pageTypeAPI === null) {
            /** @var PageTypeAPIInterface */
            $pageTypeAPI = $this->instanceManager->getInstance(PageTypeAPIInterface::class);
            $this->pageTypeAPI = $pageTypeAPI;
        }
        return $this->pageTypeAPI;
    }
    protected function getCustomPostType() : string
    {
        return $this->getPageTypeAPI()->getPageCustomPostType();
    }
}
