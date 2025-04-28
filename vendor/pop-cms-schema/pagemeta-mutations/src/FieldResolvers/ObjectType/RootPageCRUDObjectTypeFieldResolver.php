<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractRootCustomPostCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootAddPageMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootDeletePageMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootSetPageMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootUpdatePageMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/**
 * Made abstract to not initialize class (it's disabled)
 * @internal
 */
abstract class RootPageCRUDObjectTypeFieldResolver extends AbstractRootCustomPostCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootDeletePageMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePageMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootSetPageMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetPageMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootUpdatePageMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePageMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\RootAddPageMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddPageMetaMutationPayloadObjectTypeResolver;
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    protected final function getRootDeletePageMetaMutationPayloadObjectTypeResolver() : RootDeletePageMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePageMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePageMetaMutationPayloadObjectTypeResolver */
            $rootDeletePageMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePageMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePageMetaMutationPayloadObjectTypeResolver = $rootDeletePageMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePageMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetPageMetaMutationPayloadObjectTypeResolver() : RootSetPageMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetPageMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetPageMetaMutationPayloadObjectTypeResolver */
            $rootSetPageMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetPageMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetPageMetaMutationPayloadObjectTypeResolver = $rootSetPageMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetPageMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePageMetaMutationPayloadObjectTypeResolver() : RootUpdatePageMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePageMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePageMetaMutationPayloadObjectTypeResolver */
            $rootUpdatePageMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePageMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePageMetaMutationPayloadObjectTypeResolver = $rootUpdatePageMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePageMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddPageMetaMutationPayloadObjectTypeResolver() : RootAddPageMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddPageMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddPageMetaMutationPayloadObjectTypeResolver */
            $rootAddPageMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddPageMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddPageMetaMutationPayloadObjectTypeResolver = $rootAddPageMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddPageMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * Disable because we don't need `addPageMeta` and
     * `addCustomPostMeta`, it's too confusing
     */
    public function isServiceEnabled() : bool
    {
        return \false;
    }
    protected function getCustomPostEntityName() : string
    {
        return 'Page';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        $customPageEntityName = $this->getCustomPostEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if ($usePayloadableCustomPostMetaMutations) {
            switch ($fieldName) {
                case 'add' . $customPageEntityName . 'Meta':
                case 'add' . $customPageEntityName . 'Metas':
                case 'add' . $customPageEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootAddPageMetaMutationPayloadObjectTypeResolver();
                case 'update' . $customPageEntityName . 'Meta':
                case 'update' . $customPageEntityName . 'Metas':
                case 'update' . $customPageEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdatePageMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $customPageEntityName . 'Meta':
                case 'delete' . $customPageEntityName . 'Metas':
                case 'delete' . $customPageEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeletePageMetaMutationPayloadObjectTypeResolver();
                case 'set' . $customPageEntityName . 'Meta':
                case 'set' . $customPageEntityName . 'Metas':
                case 'set' . $customPageEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetPageMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'add' . $customPageEntityName . 'Meta':
            case 'add' . $customPageEntityName . 'Metas':
            case 'update' . $customPageEntityName . 'Meta':
            case 'update' . $customPageEntityName . 'Metas':
            case 'delete' . $customPageEntityName . 'Meta':
            case 'delete' . $customPageEntityName . 'Metas':
            case 'set' . $customPageEntityName . 'Meta':
            case 'set' . $customPageEntityName . 'Metas':
                return $this->getPageObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
