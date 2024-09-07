<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Categories\TypeResolvers\ObjectType\CategoryObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType\AbstractRootObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootSetCategoriesOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
/** @internal */
class RootObjectTypeFieldResolver extends AbstractRootObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolver|null
     */
    private $setCategoriesOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostBulkOperationMutationResolver|null
     */
    private $setCategoriesOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootSetCategoriesOnCustomPostInputObjectTypeResolver|null
     */
    private $rootSetCategoriesOnCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostMutationResolver|null
     */
    private $payloadableSetCategoriesOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver;
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
    public final function setSetCategoriesOnCustomPostMutationResolver(SetCategoriesOnCustomPostMutationResolver $setCategoriesOnCustomPostMutationResolver) : void
    {
        $this->setCategoriesOnCustomPostMutationResolver = $setCategoriesOnCustomPostMutationResolver;
    }
    protected final function getSetCategoriesOnCustomPostMutationResolver() : SetCategoriesOnCustomPostMutationResolver
    {
        if ($this->setCategoriesOnCustomPostMutationResolver === null) {
            /** @var SetCategoriesOnCustomPostMutationResolver */
            $setCategoriesOnCustomPostMutationResolver = $this->instanceManager->getInstance(SetCategoriesOnCustomPostMutationResolver::class);
            $this->setCategoriesOnCustomPostMutationResolver = $setCategoriesOnCustomPostMutationResolver;
        }
        return $this->setCategoriesOnCustomPostMutationResolver;
    }
    public final function setSetCategoriesOnCustomPostBulkOperationMutationResolver(SetCategoriesOnCustomPostBulkOperationMutationResolver $setCategoriesOnCustomPostBulkOperationMutationResolver) : void
    {
        $this->setCategoriesOnCustomPostBulkOperationMutationResolver = $setCategoriesOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getSetCategoriesOnCustomPostBulkOperationMutationResolver() : SetCategoriesOnCustomPostBulkOperationMutationResolver
    {
        if ($this->setCategoriesOnCustomPostBulkOperationMutationResolver === null) {
            /** @var SetCategoriesOnCustomPostBulkOperationMutationResolver */
            $setCategoriesOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(SetCategoriesOnCustomPostBulkOperationMutationResolver::class);
            $this->setCategoriesOnCustomPostBulkOperationMutationResolver = $setCategoriesOnCustomPostBulkOperationMutationResolver;
        }
        return $this->setCategoriesOnCustomPostBulkOperationMutationResolver;
    }
    public final function setGenericCategoryObjectTypeResolver(GenericCategoryObjectTypeResolver $genericCategoryObjectTypeResolver) : void
    {
        $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
    }
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
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
    public final function setPayloadableSetCategoriesOnCustomPostMutationResolver(PayloadableSetCategoriesOnCustomPostMutationResolver $payloadableSetCategoriesOnCustomPostMutationResolver) : void
    {
        $this->payloadableSetCategoriesOnCustomPostMutationResolver = $payloadableSetCategoriesOnCustomPostMutationResolver;
    }
    protected final function getPayloadableSetCategoriesOnCustomPostMutationResolver() : PayloadableSetCategoriesOnCustomPostMutationResolver
    {
        if ($this->payloadableSetCategoriesOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetCategoriesOnCustomPostMutationResolver */
            $payloadableSetCategoriesOnCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetCategoriesOnCustomPostMutationResolver::class);
            $this->payloadableSetCategoriesOnCustomPostMutationResolver = $payloadableSetCategoriesOnCustomPostMutationResolver;
        }
        return $this->payloadableSetCategoriesOnCustomPostMutationResolver;
    }
    public final function setPayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver(PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver $payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver) : void
    {
        $this->payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver = $payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver() : PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver */
            $payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver::class);
            $this->payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver = $payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableSetCategoriesOnCustomPostBulkOperationMutationResolver;
    }
    public final function setRootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver(RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver $rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver = $rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver() : RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver */
            $rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver = $rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver;
    }
    public function getCustomPostObjectTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getGenericCustomPostObjectTypeResolver();
    }
    public function getSetCategoriesMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCategoriesOnCustomPostMutationResolver();
    }
    public function getSetCategoriesBulkOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCategoriesOnCustomPostBulkOperationMutationResolver();
    }
    public function getCategoryTypeResolver() : CategoryObjectTypeResolverInterface
    {
        return $this->getGenericCategoryObjectTypeResolver();
    }
    public function getCustomPostSetCategoriesInputObjectTypeResolver() : AbstractSetCategoriesOnCustomPostInputObjectTypeResolver
    {
        return $this->getRootSetCategoriesOnCustomPostInputObjectTypeResolver();
    }
    public function getPayloadableSetCategoriesMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoriesOnCustomPostMutationResolver();
    }
    public function getPayloadableSetCategoriesBulkOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver();
    }
    protected function getRootSetCategoriesMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface
    {
        return $this->getRootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('custom post', 'post-category-mutations');
    }
    protected function getSetCategoriesFieldName() : string
    {
        return 'setCategoriesOnCustomPost';
    }
    protected function getBulkOperationSetCategoriesFieldName() : string
    {
        return 'setCategoriesOnCustomPosts';
    }
}
