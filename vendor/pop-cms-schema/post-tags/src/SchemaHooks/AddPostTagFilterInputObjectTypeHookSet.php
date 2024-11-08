<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\SchemaHooks;

use PoPCMSSchema\PostTags\TypeResolvers\InputObjectType\PostsFilterCustomPostsByTagsInputObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\InputObjectType\PostsFilterInputObjectTypeResolverInterface;
use PoPCMSSchema\Tags\SchemaHooks\AbstractAddTagFilterInputObjectTypeHookSet;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\FilterCustomPostsByTagsInputObjectTypeResolverInterface;
/** @internal */
class AddPostTagFilterInputObjectTypeHookSet extends AbstractAddTagFilterInputObjectTypeHookSet
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\InputObjectType\PostsFilterCustomPostsByTagsInputObjectTypeResolver|null
     */
    private $postsFilterCustomPostsByTagsInputObjectTypeResolver;
    protected final function getPostsFilterCustomPostsByTagsInputObjectTypeResolver() : PostsFilterCustomPostsByTagsInputObjectTypeResolver
    {
        if ($this->postsFilterCustomPostsByTagsInputObjectTypeResolver === null) {
            /** @var PostsFilterCustomPostsByTagsInputObjectTypeResolver */
            $postsFilterCustomPostsByTagsInputObjectTypeResolver = $this->instanceManager->getInstance(PostsFilterCustomPostsByTagsInputObjectTypeResolver::class);
            $this->postsFilterCustomPostsByTagsInputObjectTypeResolver = $postsFilterCustomPostsByTagsInputObjectTypeResolver;
        }
        return $this->postsFilterCustomPostsByTagsInputObjectTypeResolver;
    }
    protected function getInputObjectTypeResolverClass() : string
    {
        return PostsFilterInputObjectTypeResolverInterface::class;
    }
    protected function getFilterCustomPostsByTagsInputObjectTypeResolver() : FilterCustomPostsByTagsInputObjectTypeResolverInterface
    {
        return $this->getPostsFilterCustomPostsByTagsInputObjectTypeResolver();
    }
}
