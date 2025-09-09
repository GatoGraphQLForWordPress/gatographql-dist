<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\Hooks;

use PoPCMSSchema\CustomPosts\Hooks\AbstractAddDefaultCustomPostTypeModuleConfigurationHookSet;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
/** @internal */
class PageAddDefaultCustomPostTypeModuleConfigurationHookSet extends AbstractAddDefaultCustomPostTypeModuleConfigurationHookSet
{
    private ?PageTypeAPIInterface $pageTypeAPI = null;
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
