<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostUpdateInputObjectTypeResolver;
/** @internal */
class PostUpdateInputObjectTypeResolver extends CustomPostUpdateInputObjectTypeResolver implements \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\UpdatePostInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver|null
     */
    private $postContentAsOneofInputObjectTypeResolver;
    public final function setPostContentAsOneofInputObjectTypeResolver(\PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver $postContentAsOneofInputObjectTypeResolver) : void
    {
        $this->postContentAsOneofInputObjectTypeResolver = $postContentAsOneofInputObjectTypeResolver;
    }
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
        return 'PostUpdateInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPostContentAsOneofInputObjectTypeResolver();
    }
}
