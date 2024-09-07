<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\TagObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\SetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\GenericCustomPostSetTagsInputObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\GenericCustomPostSetTagsMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
/** @internal */
class GenericCustomPostObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
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
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\GenericCustomPostSetTagsInputObjectTypeResolver|null
     */
    private $genericCustomPostSetTagsInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver|null
     */
    private $payloadableSetTagsOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableSetTagsOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\GenericCustomPostSetTagsMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostSetTagsMutationPayloadObjectTypeResolver;
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
    public final function setSetTagsOnCustomPostMutationResolver(SetTagsOnCustomPostMutationResolver $setTagsOnCustomPostMutationResolver) : void
    {
        $this->setTagsOnCustomPostMutationResolver = $setTagsOnCustomPostMutationResolver;
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
    public final function setSetTagsOnCustomPostBulkOperationMutationResolver(SetTagsOnCustomPostBulkOperationMutationResolver $setTagsOnCustomPostBulkOperationMutationResolver) : void
    {
        $this->setTagsOnCustomPostBulkOperationMutationResolver = $setTagsOnCustomPostBulkOperationMutationResolver;
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
    public final function setGenericTagObjectTypeResolver(GenericTagObjectTypeResolver $genericTagObjectTypeResolver) : void
    {
        $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
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
    public final function setGenericCustomPostSetTagsInputObjectTypeResolver(GenericCustomPostSetTagsInputObjectTypeResolver $genericCustomPostSetTagsInputObjectTypeResolver) : void
    {
        $this->genericCustomPostSetTagsInputObjectTypeResolver = $genericCustomPostSetTagsInputObjectTypeResolver;
    }
    protected final function getGenericCustomPostSetTagsInputObjectTypeResolver() : AbstractSetTagsOnCustomPostInputObjectTypeResolver
    {
        if ($this->genericCustomPostSetTagsInputObjectTypeResolver === null) {
            /** @var GenericCustomPostSetTagsInputObjectTypeResolver */
            $genericCustomPostSetTagsInputObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetTagsInputObjectTypeResolver::class);
            $this->genericCustomPostSetTagsInputObjectTypeResolver = $genericCustomPostSetTagsInputObjectTypeResolver;
        }
        return $this->genericCustomPostSetTagsInputObjectTypeResolver;
    }
    public final function setPayloadableSetTagsOnCustomPostMutationResolver(PayloadableSetTagsOnCustomPostMutationResolver $payloadableSetTagsOnCustomPostMutationResolver) : void
    {
        $this->payloadableSetTagsOnCustomPostMutationResolver = $payloadableSetTagsOnCustomPostMutationResolver;
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
    public final function setPayloadableSetTagsOnCustomPostBulkOperationMutationResolver(PayloadableSetTagsOnCustomPostBulkOperationMutationResolver $payloadableSetTagsOnCustomPostBulkOperationMutationResolver) : void
    {
        $this->payloadableSetTagsOnCustomPostBulkOperationMutationResolver = $payloadableSetTagsOnCustomPostBulkOperationMutationResolver;
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
    public final function setGenericCustomPostSetTagsMutationPayloadObjectTypeResolver(GenericCustomPostSetTagsMutationPayloadObjectTypeResolver $genericCustomPostSetTagsMutationPayloadObjectTypeResolver) : void
    {
        $this->genericCustomPostSetTagsMutationPayloadObjectTypeResolver = $genericCustomPostSetTagsMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCustomPostSetTagsMutationPayloadObjectTypeResolver() : GenericCustomPostSetTagsMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostSetTagsMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostSetTagsMutationPayloadObjectTypeResolver */
            $genericCustomPostSetTagsMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetTagsMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostSetTagsMutationPayloadObjectTypeResolver = $genericCustomPostSetTagsMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostSetTagsMutationPayloadObjectTypeResolver;
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
        return $this->getGenericCustomPostSetTagsInputObjectTypeResolver();
    }
    protected function getCustomPostSetTagsMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface
    {
        return $this->getGenericCustomPostSetTagsMutationPayloadObjectTypeResolver();
    }
    public function getPayloadableSetTagsMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnCustomPostMutationResolver();
    }
    public function getPayloadableSetTagsBulkOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnCustomPostBulkOperationMutationResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('custom post', 'tag-mutations');
    }
}
