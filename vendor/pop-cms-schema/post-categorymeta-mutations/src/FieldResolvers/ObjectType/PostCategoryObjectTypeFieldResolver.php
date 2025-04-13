<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType\AbstractCategoryObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMetaMutations\Module as CategoryMetaMutationsModule;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration as CategoryMetaMutationsModuleConfiguration;
use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategorySetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostCategoryObjectTypeFieldResolver extends AbstractCategoryObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $postCategoryDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $postCategoryCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategoryUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $postCategoryUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\PostCategorySetMetaMutationPayloadObjectTypeResolver|null
     */
    private $postCategorySetMetaMutationPayloadObjectTypeResolver;
    protected final function getPostCategoryObjectTypeResolver() : PostCategoryObjectTypeResolver
    {
        if ($this->postCategoryObjectTypeResolver === null) {
            /** @var PostCategoryObjectTypeResolver */
            $postCategoryObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
            $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
        }
        return $this->postCategoryObjectTypeResolver;
    }
    protected final function getPostCategoryDeleteMetaMutationPayloadObjectTypeResolver() : PostCategoryDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postCategoryDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategoryDeleteMetaMutationPayloadObjectTypeResolver */
            $postCategoryDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->postCategoryDeleteMetaMutationPayloadObjectTypeResolver = $postCategoryDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postCategoryDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostCategoryAddMetaMutationPayloadObjectTypeResolver() : PostCategoryAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postCategoryCreateMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategoryAddMetaMutationPayloadObjectTypeResolver */
            $postCategoryCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryAddMetaMutationPayloadObjectTypeResolver::class);
            $this->postCategoryCreateMutationPayloadObjectTypeResolver = $postCategoryCreateMutationPayloadObjectTypeResolver;
        }
        return $this->postCategoryCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getPostCategoryUpdateMetaMutationPayloadObjectTypeResolver() : PostCategoryUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postCategoryUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategoryUpdateMetaMutationPayloadObjectTypeResolver */
            $postCategoryUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->postCategoryUpdateMetaMutationPayloadObjectTypeResolver = $postCategoryUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postCategoryUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostCategorySetMetaMutationPayloadObjectTypeResolver() : PostCategorySetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postCategorySetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategorySetMetaMutationPayloadObjectTypeResolver */
            $postCategorySetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategorySetMetaMutationPayloadObjectTypeResolver::class);
            $this->postCategorySetMetaMutationPayloadObjectTypeResolver = $postCategorySetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postCategorySetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CategoryMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CategoryMetaMutationsModule::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        if (!$usePayloadableCategoryMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getPostCategoryObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getPostCategoryAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getPostCategoryDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getPostCategorySetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getPostCategoryUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
