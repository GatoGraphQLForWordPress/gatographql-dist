<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\SchemaHooks;

use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\FilterCustomPostsByTagsInputObjectTypeResolverInterface;
abstract class AbstractCustomPostAddTagFilterInputObjectTypeHookSet extends \PoPCMSSchema\Tags\SchemaHooks\AbstractAddTagFilterInputObjectTypeHookSet
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver|null
     */
    private $customPostsFilterCustomPostsByTagsInputObjectTypeResolver;
    public final function setCustomPostsFilterCustomPostsByTagsInputObjectTypeResolver(CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver $customPostsFilterCustomPostsByTagsInputObjectTypeResolver) : void
    {
        $this->customPostsFilterCustomPostsByTagsInputObjectTypeResolver = $customPostsFilterCustomPostsByTagsInputObjectTypeResolver;
    }
    protected final function getCustomPostsFilterCustomPostsByTagsInputObjectTypeResolver() : CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver
    {
        if ($this->customPostsFilterCustomPostsByTagsInputObjectTypeResolver === null) {
            /** @var CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver */
            $customPostsFilterCustomPostsByTagsInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver::class);
            $this->customPostsFilterCustomPostsByTagsInputObjectTypeResolver = $customPostsFilterCustomPostsByTagsInputObjectTypeResolver;
        }
        return $this->customPostsFilterCustomPostsByTagsInputObjectTypeResolver;
    }
    protected function getFilterCustomPostsByTagsInputObjectTypeResolver() : FilterCustomPostsByTagsInputObjectTypeResolverInterface
    {
        return $this->getCustomPostsFilterCustomPostsByTagsInputObjectTypeResolver();
    }
}
