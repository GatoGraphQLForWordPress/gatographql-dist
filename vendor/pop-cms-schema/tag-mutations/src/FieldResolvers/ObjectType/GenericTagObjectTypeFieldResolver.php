<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\TagMutations\FieldResolvers\ObjectType\AbstractTagObjectTypeFieldResolver;
use PoPCMSSchema\TagMutations\Module as TagMutationsModule;
use PoPCMSSchema\TagMutations\ModuleConfiguration as TagMutationsModuleConfiguration;
use PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver;
use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver;
use PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver;
use PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\GenericTagTermUpdateInputObjectTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagDeleteMutationPayloadObjectTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagUpdateMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
/** @internal */
class GenericTagObjectTypeFieldResolver extends AbstractTagObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagUpdateMutationPayloadObjectTypeResolver|null
     */
    private $genericTagUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagDeleteMutationPayloadObjectTypeResolver|null
     */
    private $genericTagDeleteMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver|null
     */
    private $updateGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver|null
     */
    private $deleteGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver|null
     */
    private $payloadableUpdateGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver|null
     */
    private $payloadableDeleteGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\GenericTagTermUpdateInputObjectTypeResolver|null
     */
    private $genericTagTermUpdateInputObjectTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
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
    public final function setGenericTagUpdateMutationPayloadObjectTypeResolver(GenericTagUpdateMutationPayloadObjectTypeResolver $genericTagUpdateMutationPayloadObjectTypeResolver) : void
    {
        $this->genericTagUpdateMutationPayloadObjectTypeResolver = $genericTagUpdateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericTagUpdateMutationPayloadObjectTypeResolver() : GenericTagUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagUpdateMutationPayloadObjectTypeResolver */
            $genericTagUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagUpdateMutationPayloadObjectTypeResolver::class);
            $this->genericTagUpdateMutationPayloadObjectTypeResolver = $genericTagUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagUpdateMutationPayloadObjectTypeResolver;
    }
    public final function setGenericTagDeleteMutationPayloadObjectTypeResolver(GenericTagDeleteMutationPayloadObjectTypeResolver $genericTagDeleteMutationPayloadObjectTypeResolver) : void
    {
        $this->genericTagDeleteMutationPayloadObjectTypeResolver = $genericTagDeleteMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericTagDeleteMutationPayloadObjectTypeResolver() : GenericTagDeleteMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagDeleteMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagDeleteMutationPayloadObjectTypeResolver */
            $genericTagDeleteMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagDeleteMutationPayloadObjectTypeResolver::class);
            $this->genericTagDeleteMutationPayloadObjectTypeResolver = $genericTagDeleteMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagDeleteMutationPayloadObjectTypeResolver;
    }
    public final function setUpdateGenericTagTermMutationResolver(UpdateGenericTagTermMutationResolver $updateGenericTagTermMutationResolver) : void
    {
        $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
    }
    protected final function getUpdateGenericTagTermMutationResolver() : UpdateGenericTagTermMutationResolver
    {
        if ($this->updateGenericTagTermMutationResolver === null) {
            /** @var UpdateGenericTagTermMutationResolver */
            $updateGenericTagTermMutationResolver = $this->instanceManager->getInstance(UpdateGenericTagTermMutationResolver::class);
            $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
        }
        return $this->updateGenericTagTermMutationResolver;
    }
    public final function setDeleteGenericTagTermMutationResolver(DeleteGenericTagTermMutationResolver $deleteGenericTagTermMutationResolver) : void
    {
        $this->deleteGenericTagTermMutationResolver = $deleteGenericTagTermMutationResolver;
    }
    protected final function getDeleteGenericTagTermMutationResolver() : DeleteGenericTagTermMutationResolver
    {
        if ($this->deleteGenericTagTermMutationResolver === null) {
            /** @var DeleteGenericTagTermMutationResolver */
            $deleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(DeleteGenericTagTermMutationResolver::class);
            $this->deleteGenericTagTermMutationResolver = $deleteGenericTagTermMutationResolver;
        }
        return $this->deleteGenericTagTermMutationResolver;
    }
    public final function setPayloadableUpdateGenericTagTermMutationResolver(PayloadableUpdateGenericTagTermMutationResolver $payloadableUpdateGenericTagTermMutationResolver) : void
    {
        $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericTagTermMutationResolver() : PayloadableUpdateGenericTagTermMutationResolver
    {
        if ($this->payloadableUpdateGenericTagTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericTagTermMutationResolver */
            $payloadableUpdateGenericTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericTagTermMutationResolver::class);
            $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
        }
        return $this->payloadableUpdateGenericTagTermMutationResolver;
    }
    public final function setPayloadableDeleteGenericTagTermMutationResolver(PayloadableDeleteGenericTagTermMutationResolver $payloadableDeleteGenericTagTermMutationResolver) : void
    {
        $this->payloadableDeleteGenericTagTermMutationResolver = $payloadableDeleteGenericTagTermMutationResolver;
    }
    protected final function getPayloadableDeleteGenericTagTermMutationResolver() : PayloadableDeleteGenericTagTermMutationResolver
    {
        if ($this->payloadableDeleteGenericTagTermMutationResolver === null) {
            /** @var PayloadableDeleteGenericTagTermMutationResolver */
            $payloadableDeleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericTagTermMutationResolver::class);
            $this->payloadableDeleteGenericTagTermMutationResolver = $payloadableDeleteGenericTagTermMutationResolver;
        }
        return $this->payloadableDeleteGenericTagTermMutationResolver;
    }
    public final function setGenericTagTermUpdateInputObjectTypeResolver(GenericTagTermUpdateInputObjectTypeResolver $genericTagTermUpdateInputObjectTypeResolver) : void
    {
        $this->genericTagTermUpdateInputObjectTypeResolver = $genericTagTermUpdateInputObjectTypeResolver;
    }
    protected final function getGenericTagTermUpdateInputObjectTypeResolver() : GenericTagTermUpdateInputObjectTypeResolver
    {
        if ($this->genericTagTermUpdateInputObjectTypeResolver === null) {
            /** @var GenericTagTermUpdateInputObjectTypeResolver */
            $genericTagTermUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(GenericTagTermUpdateInputObjectTypeResolver::class);
            $this->genericTagTermUpdateInputObjectTypeResolver = $genericTagTermUpdateInputObjectTypeResolver;
        }
        return $this->genericTagTermUpdateInputObjectTypeResolver;
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
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the tag', 'tag-mutations');
            case 'delete':
                return $this->__('Delete the tag', 'tag-mutations');
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
                return ['input' => $this->getGenericTagTermUpdateInputObjectTypeResolver()];
            case 'delete':
                return [];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var TagMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(TagMutationsModule::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        switch ($fieldName) {
            case 'update':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdateGenericTagTermMutationResolver() : $this->getUpdateGenericTagTermMutationResolver();
            case 'delete':
                return $usePayloadableTagMutations ? $this->getPayloadableDeleteGenericTagTermMutationResolver() : $this->getDeleteGenericTagTermMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var TagMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(TagMutationsModule::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if (!$usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'update':
                    return $this->getGenericTagObjectTypeResolver();
                case 'delete':
                    return $this->getBooleanScalarTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'update':
                return $this->getGenericTagUpdateMutationPayloadObjectTypeResolver();
            case 'delete':
                return $this->getGenericTagDeleteMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
