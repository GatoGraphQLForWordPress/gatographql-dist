<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Categories\TypeResolvers\ObjectType\CategoryObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType\AbstractRootObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnPostMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\SetCategoriesOnPostMutationResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootSetCategoriesOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
class RootObjectTypeFieldResolver extends AbstractRootObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\SetCategoriesOnPostMutationResolver|null
     */
    private $setCategoriesOnPostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootSetCategoriesOnCustomPostInputObjectTypeResolver|null
     */
    private $rootSetCategoriesOnCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnPostMutationResolver|null
     */
    private $payloadableSetCategoriesOnPostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootSetCategoriesOnPostMutationPayloadObjectTypeResolver|null
     */
    private $rootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
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
    public final function setSetCategoriesOnPostMutationResolver(SetCategoriesOnPostMutationResolver $setCategoriesOnPostMutationResolver) : void
    {
        $this->setCategoriesOnPostMutationResolver = $setCategoriesOnPostMutationResolver;
    }
    protected final function getSetCategoriesOnPostMutationResolver() : SetCategoriesOnPostMutationResolver
    {
        if ($this->setCategoriesOnPostMutationResolver === null) {
            /** @var SetCategoriesOnPostMutationResolver */
            $setCategoriesOnPostMutationResolver = $this->instanceManager->getInstance(SetCategoriesOnPostMutationResolver::class);
            $this->setCategoriesOnPostMutationResolver = $setCategoriesOnPostMutationResolver;
        }
        return $this->setCategoriesOnPostMutationResolver;
    }
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
    public final function setRootSetCategoriesOnCustomPostInputObjectTypeResolver(RootSetCategoriesOnCustomPostInputObjectTypeResolver $rootSetCategoriesOnCustomPostInputObjectTypeResolver) : void
    {
        $this->rootSetCategoriesOnCustomPostInputObjectTypeResolver = $rootSetCategoriesOnCustomPostInputObjectTypeResolver;
    }
    protected final function getRootSetCategoriesOnCustomPostInputObjectTypeResolver() : AbstractSetCategoriesOnCustomPostInputObjectTypeResolver
    {
        if ($this->rootSetCategoriesOnCustomPostInputObjectTypeResolver === null) {
            /** @var RootSetCategoriesOnCustomPostInputObjectTypeResolver */
            $rootSetCategoriesOnCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnCustomPostInputObjectTypeResolver::class);
            $this->rootSetCategoriesOnCustomPostInputObjectTypeResolver = $rootSetCategoriesOnCustomPostInputObjectTypeResolver;
        }
        return $this->rootSetCategoriesOnCustomPostInputObjectTypeResolver;
    }
    public final function setPayloadableSetCategoriesOnPostMutationResolver(PayloadableSetCategoriesOnPostMutationResolver $payloadableSetCategoriesOnPostMutationResolver) : void
    {
        $this->payloadableSetCategoriesOnPostMutationResolver = $payloadableSetCategoriesOnPostMutationResolver;
    }
    protected final function getPayloadableSetCategoriesOnPostMutationResolver() : PayloadableSetCategoriesOnPostMutationResolver
    {
        if ($this->payloadableSetCategoriesOnPostMutationResolver === null) {
            /** @var PayloadableSetCategoriesOnPostMutationResolver */
            $payloadableSetCategoriesOnPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetCategoriesOnPostMutationResolver::class);
            $this->payloadableSetCategoriesOnPostMutationResolver = $payloadableSetCategoriesOnPostMutationResolver;
        }
        return $this->payloadableSetCategoriesOnPostMutationResolver;
    }
    public final function setRootSetCategoriesOnPostMutationPayloadObjectTypeResolver(RootSetCategoriesOnPostMutationPayloadObjectTypeResolver $rootSetCategoriesOnPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootSetCategoriesOnPostMutationPayloadObjectTypeResolver = $rootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetCategoriesOnPostMutationPayloadObjectTypeResolver() : RootSetCategoriesOnPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetCategoriesOnPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetCategoriesOnPostMutationPayloadObjectTypeResolver */
            $rootSetCategoriesOnPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnPostMutationPayloadObjectTypeResolver::class);
            $this->rootSetCategoriesOnPostMutationPayloadObjectTypeResolver = $rootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
    }
    public function getCustomPostObjectTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getPostObjectTypeResolver();
    }
    public function getSetCategoriesMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCategoriesOnPostMutationResolver();
    }
    public function getCategoryTypeResolver() : CategoryObjectTypeResolverInterface
    {
        return $this->getPostCategoryObjectTypeResolver();
    }
    public function getCustomPostSetCategoriesInputObjectTypeResolver() : AbstractSetCategoriesOnCustomPostInputObjectTypeResolver
    {
        return $this->getRootSetCategoriesOnCustomPostInputObjectTypeResolver();
    }
    public function getPayloadableSetCategoriesMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoriesOnPostMutationResolver();
    }
    protected function getRootSetCategoriesMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface
    {
        return $this->getRootSetCategoriesOnPostMutationPayloadObjectTypeResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('post', 'post-category-mutations');
    }
    protected function getSetCategoriesFieldName() : string
    {
        return 'setCategoriesOnPost';
    }
}
