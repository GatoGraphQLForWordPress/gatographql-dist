<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\ConditionalOnModule\CustomPostMedia\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMedia\FieldResolvers\ObjectType\AbstractWithFeaturedImageCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
class WithFeaturedImagePageObjectTypeFieldResolver extends AbstractWithFeaturedImageCustomPostObjectTypeFieldResolver
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
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PageObjectTypeResolver::class];
    }
    protected function getCustomPostType() : string
    {
        return $this->getPageTypeAPI()->getPageCustomPostType();
    }
}
