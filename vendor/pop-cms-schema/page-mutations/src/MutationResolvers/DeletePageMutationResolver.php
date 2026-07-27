<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractDeleteCustomPostMutationResolver;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
/** @internal */
class DeletePageMutationResolver extends AbstractDeleteCustomPostMutationResolver
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
    protected function getTargetCustomPostType() : ?string
    {
        return $this->getPageTypeAPI()->getPageCustomPostType();
    }
}
