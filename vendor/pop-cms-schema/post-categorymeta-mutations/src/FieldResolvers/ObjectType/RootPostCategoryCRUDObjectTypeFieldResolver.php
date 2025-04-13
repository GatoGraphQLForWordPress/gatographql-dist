<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType\AbstractRootCategoryCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMetaMutations\Module;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootPostCategoryCRUDObjectTypeFieldResolver extends AbstractRootCategoryCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver;
    protected final function getPostCategoryObjectTypeResolver() : PostCategoryObjectTypeResolver
    {
        if ($this->postCategoryObjectTypeResolver === null) {
            /** @var PostCategoryObjectTypeResolver */
            $postCategoryObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
            $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
        }
        return $this->postCategoryObjectTypeResolver;
    }
    protected final function getRootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver() : RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver = $rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver() : RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver = $rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver() : RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver = $rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver() : RootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver */
            $rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver = $rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver;
    }
    protected function getCategoryEntityName() : string
    {
        return 'PostCategory';
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
                    return $this->getRootAddPostCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'update' . $categoryEntityName . 'Meta':
                case 'update' . $categoryEntityName . 'Metas':
                case 'update' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $categoryEntityName . 'Meta':
                case 'delete' . $categoryEntityName . 'Metas':
                case 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver();
                case 'set' . $categoryEntityName . 'Meta':
                case 'set' . $categoryEntityName . 'Metas':
                case 'set' . $categoryEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetPostCategoryTermMetaMutationPayloadObjectTypeResolver();
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
                return $this->getPostCategoryObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
