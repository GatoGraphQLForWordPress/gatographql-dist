<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\SchemaHooks;

use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\FilterCustomPostsByCategoriesInputObjectTypeResolverInterface;
abstract class AbstractCustomPostAddCategoryFilterInputObjectTypeHookSet extends \PoPCMSSchema\Categories\SchemaHooks\AbstractAddCategoryFilterInputObjectTypeHookSet
{
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver|null
     */
    private $customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver;
    public final function setCustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver(CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver $customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver) : void
    {
        $this->customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver = $customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver;
    }
    protected final function getCustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver() : CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver
    {
        if ($this->customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver === null) {
            /** @var CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver */
            $customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver::class);
            $this->customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver = $customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver;
        }
        return $this->customPostsFilterCustomPostsByCategoriesInputObjectTypeResolver;
    }
    protected function getFilterCustomPostsByCategoriesInputObjectTypeResolver() : FilterCustomPostsByCategoriesInputObjectTypeResolverInterface
    {
        return $this->getCustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver();
    }
}
