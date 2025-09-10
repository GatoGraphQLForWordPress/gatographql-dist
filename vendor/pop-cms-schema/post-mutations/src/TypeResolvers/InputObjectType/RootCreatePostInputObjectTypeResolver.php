<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootCreateCustomPostInputObjectTypeResolver;
/** @internal */
class RootCreatePostInputObjectTypeResolver extends RootCreateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\CreatePostInputObjectTypeResolverInterface
{
    private ?\PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver $postContentAsOneofInputObjectTypeResolver = null;
    protected final function getPostContentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver
    {
        if ($this->postContentAsOneofInputObjectTypeResolver === null) {
            /** @var PostContentAsOneofInputObjectTypeResolver */
            $postContentAsOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver::class);
            $this->postContentAsOneofInputObjectTypeResolver = $postContentAsOneofInputObjectTypeResolver;
        }
        return $this->postContentAsOneofInputObjectTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'RootCreatePostInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPostContentAsOneofInputObjectTypeResolver();
    }
}
