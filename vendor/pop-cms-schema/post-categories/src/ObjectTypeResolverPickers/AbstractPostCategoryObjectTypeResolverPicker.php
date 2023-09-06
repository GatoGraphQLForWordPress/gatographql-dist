<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\ObjectTypeResolverPickers;

use PoPCMSSchema\Categories\ObjectTypeResolverPickers\CategoryObjectTypeResolverPickerInterface;
use PoPCMSSchema\Categories\ObjectTypeResolverPickers\CategoryObjectTypeResolverPickerTrait;
use PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface;
use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
abstract class AbstractPostCategoryObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker implements CategoryObjectTypeResolverPickerInterface
{
    use CategoryObjectTypeResolverPickerTrait;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface|null
     */
    private $postCategoryTypeAPI;
    public final function setPostCategoryObjectTypeResolver(PostCategoryObjectTypeResolver $postCategoryObjectTypeResolver) : void
    {
        $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
    }
    protected final function getPostCategoryObjectTypeResolver() : PostCategoryObjectTypeResolver
    {
        if ($this->postCategoryObjectTypeResolver === null) {
            /** @var PostCategoryObjectTypeResolver */
            $postCategoryObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
            $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
        }
        return $this->postCategoryObjectTypeResolver;
    }
    public final function setPostCategoryTypeAPI(PostCategoryTypeAPIInterface $postCategoryTypeAPI) : void
    {
        $this->postCategoryTypeAPI = $postCategoryTypeAPI;
    }
    protected final function getPostCategoryTypeAPI() : PostCategoryTypeAPIInterface
    {
        if ($this->postCategoryTypeAPI === null) {
            /** @var PostCategoryTypeAPIInterface */
            $postCategoryTypeAPI = $this->instanceManager->getInstance(PostCategoryTypeAPIInterface::class);
            $this->postCategoryTypeAPI = $postCategoryTypeAPI;
        }
        return $this->postCategoryTypeAPI;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getPostCategoryObjectTypeResolver();
    }
    public function isInstanceOfType(object $object) : bool
    {
        return $this->getPostCategoryTypeAPI()->isInstanceOfCategoryType($object);
    }
    /**
     * @param string|int $objectID
     */
    public function isIDOfType($objectID) : bool
    {
        return $this->getPostCategoryTypeAPI()->categoryExists($objectID);
    }
    public function getCategoryTaxonomy() : string
    {
        return $this->getPostCategoryTypeAPI()->getPostCategoryTaxonomyName();
    }
}
