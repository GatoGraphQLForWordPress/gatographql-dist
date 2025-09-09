<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\SchemaHooks;

use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\FilterCustomPostsByTagsInputObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCustomPostAddTagFilterInputObjectTypeHookSet extends \PoPCMSSchema\Tags\SchemaHooks\AbstractAddTagFilterInputObjectTypeHookSet
{
    private ?CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver $customPostsFilterCustomPostsByTagsInputObjectTypeResolver = null;
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
