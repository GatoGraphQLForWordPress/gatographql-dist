<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\SchemaHooks;

use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\SchemaHooks\AbstractCustomPostMutationResolverHookSet;
/** @internal */
class PageMutationResolverHookSet extends AbstractCustomPostMutationResolverHookSet
{
    use \PoPCMSSchema\PageMetaMutations\SchemaHooks\PageMutationResolverHookSetTrait;
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    protected function getCustomPostTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getPageObjectTypeResolver();
    }
}
