<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
/** @internal */
abstract class AbstractCustomPostObjectTypeResolver extends AbstractObjectTypeResolver implements \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Representation of a custom post', 'customposts');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        return $this->getCustomPostTypeAPI()->getID($object);
    }
}
