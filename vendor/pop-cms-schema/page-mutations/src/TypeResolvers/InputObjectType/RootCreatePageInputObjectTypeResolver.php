<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootCreateCustomPostInputObjectTypeResolver;
/** @internal */
class RootCreatePageInputObjectTypeResolver extends RootCreateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\CreatePageInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageContentAsOneofInputObjectTypeResolver|null
     */
    private $pageContentAsOneofInputObjectTypeResolver;
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
        return 'RootCreatePageInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPageContentAsOneofInputObjectTypeResolver();
    }
}
