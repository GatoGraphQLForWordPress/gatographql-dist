<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootUpdateCustomPostInputObjectTypeResolver;
/** @internal */
class RootUpdatePostInputObjectTypeResolver extends RootUpdateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\UpdatePostInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\PostContentAsOneofInputObjectTypeResolver|null
     */
    private $postContentAsOneofInputObjectTypeResolver;
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
        return 'RootUpdatePostInput';
    }
    protected function getContentAsOneofInputObjectTypeResolver() : AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getPostContentAsOneofInputObjectTypeResolver();
    }
}
