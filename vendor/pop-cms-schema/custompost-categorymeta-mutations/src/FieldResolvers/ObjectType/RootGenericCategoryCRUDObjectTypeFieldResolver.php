<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType\AbstractRootCategoryCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMetaMutations\Module;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootGenericCategoryCRUDObjectTypeFieldResolver extends AbstractRootCategoryCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
    }
    protected final function getRootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver() : RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver() : RootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver() : RootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver() : RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver = $rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected function getCategoryEntityName() : string
    {
        return 'Category';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        $categoryEntityName = $this->getCategoryEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        if ($usePayloadableCategoryMetaMutations) {
            switch ($fieldName) {
                case 'add' . $categoryEntityName . 'Meta':
                case 'add' . $categoryEntityName . 'Metas':
                case 'add' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'update' . $categoryEntityName . 'Meta':
                case 'update' . $categoryEntityName . 'Metas':
                case 'update' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdateGenericCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $categoryEntityName . 'Meta':
                case 'delete' . $categoryEntityName . 'Metas':
                case 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'set' . $categoryEntityName . 'Meta':
                case 'set' . $categoryEntityName . 'Metas':
                case 'set' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetGenericCategoryTermMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'Meta':
            case 'add' . $categoryEntityName . 'Metas':
            case 'update' . $categoryEntityName . 'Meta':
            case 'update' . $categoryEntityName . 'Metas':
            case 'delete' . $categoryEntityName . 'Meta':
            case 'delete' . $categoryEntityName . 'Metas':
            case 'set' . $categoryEntityName . 'Meta':
            case 'set' . $categoryEntityName . 'Metas':
                return $this->getGenericCategoryObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
