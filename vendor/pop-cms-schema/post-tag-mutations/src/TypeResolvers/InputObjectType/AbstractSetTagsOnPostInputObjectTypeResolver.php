<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\TagObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
/** @internal */
abstract class AbstractSetTagsOnPostInputObjectTypeResolver extends AbstractSetTagsOnCustomPostInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    public final function setPostTagObjectTypeResolver(PostTagObjectTypeResolver $postTagObjectTypeResolver) : void
    {
        $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
    }
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
    }
    protected function getTagTypeResolver() : TagObjectTypeResolverInterface
    {
        return $this->getPostTagObjectTypeResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('post', 'posttag-mutations');
    }
}
