<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\FieldResolvers\ObjectType\AbstractCategoryObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMutations\Module as CategoryMutationsModule;
use PoPCMSSchema\CategoryMutations\ModuleConfiguration as CategoryMutationsModuleConfiguration;
use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\PostCategoryTermUpdateInputObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostCategoryDeleteMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostCategoryUpdateMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
/** @internal */
class PostCategoryObjectTypeFieldResolver extends AbstractCategoryObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostCategoryUpdateMutationPayloadObjectTypeResolver|null
     */
    private $postCategoryUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\PostCategoryDeleteMutationPayloadObjectTypeResolver|null
     */
    private $postCategoryDeleteMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermMutationResolver|null
     */
    private $updatePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver|null
     */
    private $deletePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver|null
     */
    private $payloadableUpdatePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver|null
     */
    private $payloadableDeletePostCategoryTermMutationResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\PostCategoryTermUpdateInputObjectTypeResolver|null
     */
    private $postCategoryTermUpdateInputObjectTypeResolver;
    public final function setPostCategoryObjectTypeResolver(PostCategoryObjectTypeResolver $postCategoryObjectTypeResolver) : void
    {
        $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
    }
    protected final function getPostCategoryObjectTypeResolver() : PostCategoryObjectTypeResolver
    {
        if ($this->postCategoryObjectTypeResolver === null) {
            /** @var PostCategoryObjectTypeResolver */
            $postCategoryObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
            $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
        }
        return $this->postCategoryObjectTypeResolver;
    }
    public final function setPostCategoryUpdateMutationPayloadObjectTypeResolver(PostCategoryUpdateMutationPayloadObjectTypeResolver $postCategoryUpdateMutationPayloadObjectTypeResolver) : void
    {
        $this->postCategoryUpdateMutationPayloadObjectTypeResolver = $postCategoryUpdateMutationPayloadObjectTypeResolver;
    }
    protected final function getPostCategoryUpdateMutationPayloadObjectTypeResolver() : PostCategoryUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->postCategoryUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategoryUpdateMutationPayloadObjectTypeResolver */
            $postCategoryUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryUpdateMutationPayloadObjectTypeResolver::class);
            $this->postCategoryUpdateMutationPayloadObjectTypeResolver = $postCategoryUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->postCategoryUpdateMutationPayloadObjectTypeResolver;
    }
    public final function setPostCategoryDeleteMutationPayloadObjectTypeResolver(PostCategoryDeleteMutationPayloadObjectTypeResolver $postCategoryDeleteMutationPayloadObjectTypeResolver) : void
    {
        $this->postCategoryDeleteMutationPayloadObjectTypeResolver = $postCategoryDeleteMutationPayloadObjectTypeResolver;
    }
    protected final function getPostCategoryDeleteMutationPayloadObjectTypeResolver() : PostCategoryDeleteMutationPayloadObjectTypeResolver
    {
        if ($this->postCategoryDeleteMutationPayloadObjectTypeResolver === null) {
            /** @var PostCategoryDeleteMutationPayloadObjectTypeResolver */
            $postCategoryDeleteMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryDeleteMutationPayloadObjectTypeResolver::class);
            $this->postCategoryDeleteMutationPayloadObjectTypeResolver = $postCategoryDeleteMutationPayloadObjectTypeResolver;
        }
        return $this->postCategoryDeleteMutationPayloadObjectTypeResolver;
    }
    public final function setUpdatePostCategoryTermMutationResolver(UpdatePostCategoryTermMutationResolver $updatePostCategoryTermMutationResolver) : void
    {
        $this->updatePostCategoryTermMutationResolver = $updatePostCategoryTermMutationResolver;
    }
    protected final function getUpdatePostCategoryTermMutationResolver() : UpdatePostCategoryTermMutationResolver
    {
        if ($this->updatePostCategoryTermMutationResolver === null) {
            /** @var UpdatePostCategoryTermMutationResolver */
            $updatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(UpdatePostCategoryTermMutationResolver::class);
            $this->updatePostCategoryTermMutationResolver = $updatePostCategoryTermMutationResolver;
        }
        return $this->updatePostCategoryTermMutationResolver;
    }
    public final function setDeletePostCategoryTermMutationResolver(DeletePostCategoryTermMutationResolver $deletePostCategoryTermMutationResolver) : void
    {
        $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
    }
    protected final function getDeletePostCategoryTermMutationResolver() : DeletePostCategoryTermMutationResolver
    {
        if ($this->deletePostCategoryTermMutationResolver === null) {
            /** @var DeletePostCategoryTermMutationResolver */
            $deletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(DeletePostCategoryTermMutationResolver::class);
            $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
        }
        return $this->deletePostCategoryTermMutationResolver;
    }
    public final function setPayloadableUpdatePostCategoryTermMutationResolver(PayloadableUpdatePostCategoryTermMutationResolver $payloadableUpdatePostCategoryTermMutationResolver) : void
    {
        $this->payloadableUpdatePostCategoryTermMutationResolver = $payloadableUpdatePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableUpdatePostCategoryTermMutationResolver() : PayloadableUpdatePostCategoryTermMutationResolver
    {
        if ($this->payloadableUpdatePostCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdatePostCategoryTermMutationResolver */
            $payloadableUpdatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostCategoryTermMutationResolver::class);
            $this->payloadableUpdatePostCategoryTermMutationResolver = $payloadableUpdatePostCategoryTermMutationResolver;
        }
        return $this->payloadableUpdatePostCategoryTermMutationResolver;
    }
    public final function setPayloadableDeletePostCategoryTermMutationResolver(PayloadableDeletePostCategoryTermMutationResolver $payloadableDeletePostCategoryTermMutationResolver) : void
    {
        $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableDeletePostCategoryTermMutationResolver() : PayloadableDeletePostCategoryTermMutationResolver
    {
        if ($this->payloadableDeletePostCategoryTermMutationResolver === null) {
            /** @var PayloadableDeletePostCategoryTermMutationResolver */
            $payloadableDeletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostCategoryTermMutationResolver::class);
            $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
        }
        return $this->payloadableDeletePostCategoryTermMutationResolver;
    }
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    public final function setPostCategoryTermUpdateInputObjectTypeResolver(PostCategoryTermUpdateInputObjectTypeResolver $postCategoryTermUpdateInputObjectTypeResolver) : void
    {
        $this->postCategoryTermUpdateInputObjectTypeResolver = $postCategoryTermUpdateInputObjectTypeResolver;
    }
    protected final function getPostCategoryTermUpdateInputObjectTypeResolver() : PostCategoryTermUpdateInputObjectTypeResolver
    {
        if ($this->postCategoryTermUpdateInputObjectTypeResolver === null) {
            /** @var PostCategoryTermUpdateInputObjectTypeResolver */
            $postCategoryTermUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryTermUpdateInputObjectTypeResolver::class);
            $this->postCategoryTermUpdateInputObjectTypeResolver = $postCategoryTermUpdateInputObjectTypeResolver;
        }
        return $this->postCategoryTermUpdateInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the post category', 'category-mutations');
            case 'delete':
                return $this->__('Delete the post category', 'category-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'update':
                return ['input' => $this->getPostCategoryTermUpdateInputObjectTypeResolver()];
            case 'delete':
                return [];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CategoryMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CategoryMutationsModule::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        switch ($fieldName) {
            case 'update':
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdatePostCategoryTermMutationResolver() : $this->getUpdatePostCategoryTermMutationResolver();
            case 'delete':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeletePostCategoryTermMutationResolver() : $this->getDeletePostCategoryTermMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CategoryMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CategoryMutationsModule::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if (!$usePayloadableCategoryMutations) {
            switch ($fieldName) {
                case 'update':
                    return $this->getPostCategoryObjectTypeResolver();
                case 'delete':
                    return $this->getBooleanScalarTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'update':
                return $this->getPostCategoryUpdateMutationPayloadObjectTypeResolver();
            case 'delete':
                return $this->getPostCategoryDeleteMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
