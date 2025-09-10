<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostUpdateInputObjectTypeResolver;
/** @internal */
class PageUpdateInputObjectTypeResolver extends AbstractCustomPostUpdateInputObjectTypeResolver implements \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\UpdatePageInputObjectTypeResolverInterface
{
    private ?\PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver $pageContentAsOneofInputObjectTypeResolver = null;
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
    protected function addCustomPostParentInputField() : bool
    {
        return \true;
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPageContentAsOneofInputObjectTypeResolver();
    }
}
