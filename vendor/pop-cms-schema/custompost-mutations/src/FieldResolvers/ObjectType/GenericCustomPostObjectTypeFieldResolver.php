<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMutations\Module as CustomPostMutationsModule;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration as CustomPostMutationsModuleConfiguration;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\GenericCustomPostUpdateInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\GenericCustomPostUpdateMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\GenericCustomPostUpdateMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver|null
     */
    private $updateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver|null
     */
    private $payloadableUpdateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\GenericCustomPostUpdateInputObjectTypeResolver|null
     */
    private $genericCustomPostUpdateInputObjectTypeResolver;
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
    public final function setGenericCustomPostUpdateMutationPayloadObjectTypeResolver(GenericCustomPostUpdateMutationPayloadObjectTypeResolver $genericCustomPostUpdateMutationPayloadObjectTypeResolver) : void
    {
        $this->genericCustomPostUpdateMutationPayloadObjectTypeResolver = $genericCustomPostUpdateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCustomPostUpdateMutationPayloadObjectTypeResolver() : GenericCustomPostUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostUpdateMutationPayloadObjectTypeResolver */
            $genericCustomPostUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostUpdateMutationPayloadObjectTypeResolver = $genericCustomPostUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostUpdateMutationPayloadObjectTypeResolver;
    }
    public final function setUpdateGenericCustomPostMutationResolver(UpdateGenericCustomPostMutationResolver $updateGenericCustomPostMutationResolver) : void
    {
        $this->updateGenericCustomPostMutationResolver = $updateGenericCustomPostMutationResolver;
    }
    protected final function getUpdateGenericCustomPostMutationResolver() : UpdateGenericCustomPostMutationResolver
    {
        if ($this->updateGenericCustomPostMutationResolver === null) {
            /** @var UpdateGenericCustomPostMutationResolver */
            $updateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(UpdateGenericCustomPostMutationResolver::class);
            $this->updateGenericCustomPostMutationResolver = $updateGenericCustomPostMutationResolver;
        }
        return $this->updateGenericCustomPostMutationResolver;
    }
    public final function setPayloadableUpdateGenericCustomPostMutationResolver(PayloadableUpdateGenericCustomPostMutationResolver $payloadableUpdateGenericCustomPostMutationResolver) : void
    {
        $this->payloadableUpdateGenericCustomPostMutationResolver = $payloadableUpdateGenericCustomPostMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCustomPostMutationResolver() : PayloadableUpdateGenericCustomPostMutationResolver
    {
        if ($this->payloadableUpdateGenericCustomPostMutationResolver === null) {
            /** @var PayloadableUpdateGenericCustomPostMutationResolver */
            $payloadableUpdateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCustomPostMutationResolver::class);
            $this->payloadableUpdateGenericCustomPostMutationResolver = $payloadableUpdateGenericCustomPostMutationResolver;
        }
        return $this->payloadableUpdateGenericCustomPostMutationResolver;
    }
    public final function setGenericCustomPostUpdateInputObjectTypeResolver(GenericCustomPostUpdateInputObjectTypeResolver $genericCustomPostUpdateInputObjectTypeResolver) : void
    {
        $this->genericCustomPostUpdateInputObjectTypeResolver = $genericCustomPostUpdateInputObjectTypeResolver;
    }
    protected final function getGenericCustomPostUpdateInputObjectTypeResolver() : GenericCustomPostUpdateInputObjectTypeResolver
    {
        if ($this->genericCustomPostUpdateInputObjectTypeResolver === null) {
            /** @var GenericCustomPostUpdateInputObjectTypeResolver */
            $genericCustomPostUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateInputObjectTypeResolver::class);
            $this->genericCustomPostUpdateInputObjectTypeResolver = $genericCustomPostUpdateInputObjectTypeResolver;
        }
        return $this->genericCustomPostUpdateInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the post', 'post-mutations');
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
                return ['input' => $this->getGenericCustomPostUpdateInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'update':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdateGenericCustomPostMutationResolver() : $this->getUpdateGenericCustomPostMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'update':
                return $usePayloadableCustomPostMutations ? $this->getGenericCustomPostUpdateMutationPayloadObjectTypeResolver() : $this->getGenericCustomPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
