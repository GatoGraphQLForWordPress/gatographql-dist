<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoPCMSSchema\PostTags\RelationalTypeDataLoaders\ObjectType\PostTagObjectTypeDataLoader;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\TagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\AbstractTagObjectTypeResolver;
class PostTagObjectTypeResolver extends AbstractTagObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\RelationalTypeDataLoaders\ObjectType\PostTagObjectTypeDataLoader|null
     */
    private $postTagObjectTypeDataLoader;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    public final function setPostTagObjectTypeDataLoader(PostTagObjectTypeDataLoader $postTagObjectTypeDataLoader) : void
    {
        $this->postTagObjectTypeDataLoader = $postTagObjectTypeDataLoader;
    }
    protected final function getPostTagObjectTypeDataLoader() : PostTagObjectTypeDataLoader
    {
        if ($this->postTagObjectTypeDataLoader === null) {
            /** @var PostTagObjectTypeDataLoader */
            $postTagObjectTypeDataLoader = $this->instanceManager->getInstance(PostTagObjectTypeDataLoader::class);
            $this->postTagObjectTypeDataLoader = $postTagObjectTypeDataLoader;
        }
        return $this->postTagObjectTypeDataLoader;
    }
    public final function setPostTagTypeAPI(PostTagTypeAPIInterface $postTagTypeAPI) : void
    {
        $this->postTagTypeAPI = $postTagTypeAPI;
    }
    protected final function getPostTagTypeAPI() : PostTagTypeAPIInterface
    {
        if ($this->postTagTypeAPI === null) {
            /** @var PostTagTypeAPIInterface */
            $postTagTypeAPI = $this->instanceManager->getInstance(PostTagTypeAPIInterface::class);
            $this->postTagTypeAPI = $postTagTypeAPI;
        }
        return $this->postTagTypeAPI;
    }
    public function getTagTypeAPI() : TagTypeAPIInterface
    {
        return $this->getPostTagTypeAPI();
    }
    public function getTypeName() : string
    {
        return 'PostTag';
    }
    public function getTypeDescription() : ?string
    {
        return \sprintf($this->__('Representation of a tag, added to a post (taxonomy: "%s")', 'post-tags'), $this->getPostTagTypeAPI()->getPostTagTaxonomyName());
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getPostTagObjectTypeDataLoader();
    }
}
