<?php

declare (strict_types=1);
namespace PoPCMSSchema\Posts\ObjectTypeResolverPickers;

use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
/** @internal */
abstract class AbstractPostObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface|null
     */
    private $postTypeAPI;
    public final function setPostObjectTypeResolver(PostObjectTypeResolver $postObjectTypeResolver) : void
    {
        $this->postObjectTypeResolver = $postObjectTypeResolver;
    }
    protected final function getPostObjectTypeResolver() : PostObjectTypeResolver
    {
        if ($this->postObjectTypeResolver === null) {
            /** @var PostObjectTypeResolver */
            $postObjectTypeResolver = $this->instanceManager->getInstance(PostObjectTypeResolver::class);
            $this->postObjectTypeResolver = $postObjectTypeResolver;
        }
        return $this->postObjectTypeResolver;
    }
    public final function setPostTypeAPI(PostTypeAPIInterface $postTypeAPI) : void
    {
        $this->postTypeAPI = $postTypeAPI;
    }
    protected final function getPostTypeAPI() : PostTypeAPIInterface
    {
        if ($this->postTypeAPI === null) {
            /** @var PostTypeAPIInterface */
            $postTypeAPI = $this->instanceManager->getInstance(PostTypeAPIInterface::class);
            $this->postTypeAPI = $postTypeAPI;
        }
        return $this->postTypeAPI;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getPostObjectTypeResolver();
    }
    public function isInstanceOfType(object $object) : bool
    {
        return $this->getPostTypeAPI()->isInstanceOfPostType($object);
    }
    /**
     * @param string|int $objectID
     */
    public function isIDOfType($objectID) : bool
    {
        return $this->getPostTypeAPI()->postExists($objectID);
    }
}
