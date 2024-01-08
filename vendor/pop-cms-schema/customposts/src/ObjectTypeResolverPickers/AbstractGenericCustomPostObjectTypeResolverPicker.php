<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPosts\Module;
use PoPCMSSchema\CustomPosts\ModuleConfiguration;
use PoPCMSSchema\CustomPosts\Registries\CustomPostObjectTypeResolverPickerRegistryInterface;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractGenericCustomPostObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker implements \PoPCMSSchema\CustomPosts\ObjectTypeResolverPickers\CustomPostObjectTypeResolverPickerInterface
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\Registries\CustomPostObjectTypeResolverPickerRegistryInterface|null
     */
    private $customPostObjectTypeResolverPickerRegistry;
    public final function setGenericCustomPostObjectTypeResolver(GenericCustomPostObjectTypeResolver $genericCustomPostObjectTypeResolver) : void
    {
        $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
    }
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    public final function setCustomPostTypeAPI(CustomPostTypeAPIInterface $customPostTypeAPI) : void
    {
        $this->customPostTypeAPI = $customPostTypeAPI;
    }
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
    }
    public final function setCustomPostObjectTypeResolverPickerRegistry(CustomPostObjectTypeResolverPickerRegistryInterface $customPostObjectTypeResolverPickerRegistry) : void
    {
        $this->customPostObjectTypeResolverPickerRegistry = $customPostObjectTypeResolverPickerRegistry;
    }
    protected final function getCustomPostObjectTypeResolverPickerRegistry() : CustomPostObjectTypeResolverPickerRegistryInterface
    {
        if ($this->customPostObjectTypeResolverPickerRegistry === null) {
            /** @var CustomPostObjectTypeResolverPickerRegistryInterface */
            $customPostObjectTypeResolverPickerRegistry = $this->instanceManager->getInstance(CustomPostObjectTypeResolverPickerRegistryInterface::class);
            $this->customPostObjectTypeResolverPickerRegistry = $customPostObjectTypeResolverPickerRegistry;
        }
        return $this->customPostObjectTypeResolverPickerRegistry;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getGenericCustomPostObjectTypeResolver();
    }
    public function isInstanceOfType(object $object) : bool
    {
        return $this->getCustomPostTypeAPI()->isInstanceOfCustomPostType($object);
    }
    /**
     * @param string|int $objectID
     */
    public function isIDOfType($objectID) : bool
    {
        return $this->getCustomPostTypeAPI()->customPostExists($objectID);
    }
    /**
     * Process last, as to allow specific Pickers to take precedence,
     * such as for Post or Page. Only when no other Picker is available,
     * will GenericCustomPost be used.
     */
    public function getPriorityToAttachToClasses() : int
    {
        return 0;
    }
    /**
     * Check if there are generic custom post types,
     * and only then enable it
     */
    public function isServiceEnabled() : bool
    {
        $customPostObjectTypeResolverPickers = $this->getCustomPostObjectTypeResolverPickerRegistry()->getCustomPostObjectTypeResolverPickers();
        $nonGenericCustomPostTypes = [];
        foreach ($customPostObjectTypeResolverPickers as $customPostObjectTypeResolverPicker) {
            // Skip this class, we're interested in all the non-generic ones
            if ($customPostObjectTypeResolverPicker === $this) {
                continue;
            }
            $nonGenericCustomPostTypes[] = $customPostObjectTypeResolverPicker->getCustomPostType();
        }
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return \array_diff($moduleConfiguration->getQueryableCustomPostTypes(), $nonGenericCustomPostTypes) !== [];
    }
    /**
     * Return empty value is OK, because this method will
     * never be called on this class.
     *
     * @see `isServiceEnabled`
     */
    public function getCustomPostType() : string
    {
        return '';
    }
}
