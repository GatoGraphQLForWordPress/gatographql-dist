<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoPCMSSchema\Categories\TypeAPIs\CategoryTypeAPIInterface;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\AbstractCategoryObjectTypeResolver;
use PoPCMSSchema\PostCategories\RelationalTypeDataLoaders\ObjectType\PostCategoryObjectTypeDataLoader;
use PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface;
class PostCategoryObjectTypeResolver extends AbstractCategoryObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostCategories\RelationalTypeDataLoaders\ObjectType\PostCategoryObjectTypeDataLoader|null
     */
    private $postCategoryObjectTypeDataLoader;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface|null
     */
    private $postCategoryTypeAPI;
    public final function setPostCategoryObjectTypeDataLoader(PostCategoryObjectTypeDataLoader $postCategoryObjectTypeDataLoader) : void
    {
        $this->postCategoryObjectTypeDataLoader = $postCategoryObjectTypeDataLoader;
    }
    protected final function getPostCategoryObjectTypeDataLoader() : PostCategoryObjectTypeDataLoader
    {
        if ($this->postCategoryObjectTypeDataLoader === null) {
            /** @var PostCategoryObjectTypeDataLoader */
            $postCategoryObjectTypeDataLoader = $this->instanceManager->getInstance(PostCategoryObjectTypeDataLoader::class);
            $this->postCategoryObjectTypeDataLoader = $postCategoryObjectTypeDataLoader;
        }
        return $this->postCategoryObjectTypeDataLoader;
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
    public function getTypeName() : string
    {
        return 'PostCategory';
    }
    public function getTypeDescription() : ?string
    {
        return \sprintf($this->__('Representation of a category, added to a post (taxonomy: "%s")', 'post-categories'), $this->getPostCategoryTypeAPI()->getPostCategoryTaxonomyName());
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostCategoryObjectTypeDataLoader();
    }
    public function getCategoryTypeAPI() : CategoryTypeAPIInterface
    {
        return $this->getPostCategoryTypeAPI();
    }
}
