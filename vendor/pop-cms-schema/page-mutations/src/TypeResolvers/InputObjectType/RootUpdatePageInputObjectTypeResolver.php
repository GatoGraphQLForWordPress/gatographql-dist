<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootUpdateCustomPostInputObjectTypeResolver;
/** @internal */
class RootUpdatePageInputObjectTypeResolver extends RootUpdateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\UpdatePageInputObjectTypeResolverInterface
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
        return 'RootUpdatePageInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPageContentAsOneofInputObjectTypeResolver();
    }
}
