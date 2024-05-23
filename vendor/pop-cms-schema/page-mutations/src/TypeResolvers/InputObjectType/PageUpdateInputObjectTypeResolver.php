<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostUpdateInputObjectTypeResolver;
/** @internal */
class PageUpdateInputObjectTypeResolver extends CustomPostUpdateInputObjectTypeResolver implements \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\UpdatePageInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver|null
     */
    private $pageContentAsOneofInputObjectTypeResolver;
    public final function setPageContentAsOneofInputObjectTypeResolver(\PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver $pageContentAsOneofInputObjectTypeResolver) : void
    {
        $this->pageContentAsOneofInputObjectTypeResolver = $pageContentAsOneofInputObjectTypeResolver;
    }
    protected final function getPageContentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver
    {
        if ($this->pageContentAsOneofInputObjectTypeResolver === null) {
            /** @var PageContentAsOneofInputObjectTypeResolver */
            $pageContentAsOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver::class);
            $this->pageContentAsOneofInputObjectTypeResolver = $pageContentAsOneofInputObjectTypeResolver;
        }
        return $this->pageContentAsOneofInputObjectTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'PageUpdateInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPageContentAsOneofInputObjectTypeResolver();
    }
}
