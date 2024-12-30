<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectTypeResolverPickers;

use PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface;
use PoP\ComponentModel\AttachableExtensions\AttachableExtensionTrait;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractObjectTypeResolverPicker extends AbstractBasicService implements \PoP\ComponentModel\ObjectTypeResolverPickers\ObjectTypeResolverPickerInterface
{
    use AttachableExtensionTrait;
    /**
     * @var \PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface|null
     */
    private $attachableExtensionManager;
    protected final function getAttachableExtensionManager() : AttachableExtensionManagerInterface
    {
        if ($this->attachableExtensionManager === null) {
            /** @var AttachableExtensionManagerInterface */
            $attachableExtensionManager = $this->instanceManager->getInstance(AttachableExtensionManagerInterface::class);
            $this->attachableExtensionManager = $attachableExtensionManager;
        }
        return $this->attachableExtensionManager;
    }
    /**
     * @return string[]
     */
    public final function getClassesToAttachTo() : array
    {
        return $this->getUnionTypeResolverClassesToAttachTo();
    }
}
