<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\TagObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType\AbstractRootObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootSetTagsOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver;
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
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostMutationResolver|null
     */
    private $setTagsOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostBulkOperationMutationResolver|null
     */
    private $setTagsOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootSetTagsOnCustomPostInputObjectTypeResolver|null
     */
    private $rootSetTagsOnCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver|null
     */
    private $payloadableSetTagsOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableSetTagsOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver;
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    protected final function getSetTagsOnCustomPostMutationResolver() : SetTagsOnCustomPostMutationResolver
    {
        if ($this->setTagsOnCustomPostMutationResolver === null) {
            /** @var SetTagsOnCustomPostMutationResolver */
            $setTagsOnCustomPostMutationResolver = $this->instanceManager->getInstance(SetTagsOnCustomPostMutationResolver::class);
            $this->setTagsOnCustomPostMutationResolver = $setTagsOnCustomPostMutationResolver;
        }
        return $this->setTagsOnCustomPostMutationResolver;
    }
    protected final function getSetTagsOnCustomPostBulkOperationMutationResolver() : SetTagsOnCustomPostBulkOperationMutationResolver
    {
        if ($this->setTagsOnCustomPostBulkOperationMutationResolver === null) {
            /** @var SetTagsOnCustomPostBulkOperationMutationResolver */
            $setTagsOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(SetTagsOnCustomPostBulkOperationMutationResolver::class);
            $this->setTagsOnCustomPostBulkOperationMutationResolver = $setTagsOnCustomPostBulkOperationMutationResolver;
        }
        return $this->setTagsOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getGenericTagObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    protected final function getRootSetTagsOnCustomPostInputObjectTypeResolver() : AbstractSetTagsOnCustomPostInputObjectTypeResolver
    {
        if ($this->rootSetTagsOnCustomPostInputObjectTypeResolver === null) {
            /** @var RootSetTagsOnCustomPostInputObjectTypeResolver */
            $rootSetTagsOnCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetTagsOnCustomPostInputObjectTypeResolver::class);
            $this->rootSetTagsOnCustomPostInputObjectTypeResolver = $rootSetTagsOnCustomPostInputObjectTypeResolver;
        }
        return $this->rootSetTagsOnCustomPostInputObjectTypeResolver;
    }
    protected final function getPayloadableSetTagsOnCustomPostMutationResolver() : PayloadableSetTagsOnCustomPostMutationResolver
    {
        if ($this->payloadableSetTagsOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetTagsOnCustomPostMutationResolver */
            $payloadableSetTagsOnCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagsOnCustomPostMutationResolver::class);
            $this->payloadableSetTagsOnCustomPostMutationResolver = $payloadableSetTagsOnCustomPostMutationResolver;
        }
        return $this->payloadableSetTagsOnCustomPostMutationResolver;
    }
    protected final function getPayloadableSetTagsOnCustomPostBulkOperationMutationResolver() : PayloadableSetTagsOnCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableSetTagsOnCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableSetTagsOnCustomPostBulkOperationMutationResolver */
            $payloadableSetTagsOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagsOnCustomPostBulkOperationMutationResolver::class);
            $this->payloadableSetTagsOnCustomPostBulkOperationMutationResolver = $payloadableSetTagsOnCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableSetTagsOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getRootSetTagsOnCustomPostMutationPayloadObjectTypeResolver() : RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver */
            $rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver = $rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetTagsOnCustomPostMutationPayloadObjectTypeResolver;
    }
    public function getCustomPostObjectTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getGenericCustomPostObjectTypeResolver();
    }
    public function getSetTagsMutationResolver() : MutationResolverInterface
    {
        return $this->getSetTagsOnCustomPostMutationResolver();
    }
    public function getSetTagsBulkOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetTagsOnCustomPostBulkOperationMutationResolver();
    }
    public function getTagTypeResolver() : TagObjectTypeResolverInterface
    {
        return $this->getGenericTagObjectTypeResolver();
    }
    public function getCustomPostSetTagsInputObjectTypeResolver() : AbstractSetTagsOnCustomPostInputObjectTypeResolver
    {
        return $this->getRootSetTagsOnCustomPostInputObjectTypeResolver();
    }
    public function getPayloadableSetTagsMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnCustomPostMutationResolver();
    }
    public function getPayloadableSetTagsBulkOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnCustomPostBulkOperationMutationResolver();
    }
    protected function getRootSetTagsMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface
    {
        return $this->getRootSetTagsOnCustomPostMutationPayloadObjectTypeResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('custom post', 'post-tag-mutations');
    }
    protected function getSetTagsFieldName() : string
    {
        return 'setTagsOnCustomPost';
    }
    protected function getBulkOperationSetTagsFieldName() : string
    {
        return 'setTagsOnCustomPosts';
    }
}
