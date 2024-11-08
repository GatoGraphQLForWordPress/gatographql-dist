<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\ObjectTypeResolverPickers;

use PoPCMSSchema\Tags\ObjectTypeResolverPickers\TagObjectTypeResolverPickerInterface;
use PoPCMSSchema\Tags\ObjectTypeResolverPickers\TagObjectTypeResolverPickerTrait;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractPostTagObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker implements TagObjectTypeResolverPickerInterface
{
    use TagObjectTypeResolverPickerTrait;
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
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
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getPostTagObjectTypeResolver();
    }
    public function isInstanceOfType(object $object) : bool
    {
        return $this->getPostTagTypeAPI()->isInstanceOfTagType($object);
    }
    /**
     * @param string|int $objectID
     */
    public function isIDOfType($objectID) : bool
    {
        return $this->getPostTagTypeAPI()->tagExists($objectID);
    }
    /**
     * @return string[]
     */
    public function getTagTaxonomies() : array
    {
        return $this->getPostTagTypeAPI()->getRegisteredPostTagTaxonomyNames();
    }
}
