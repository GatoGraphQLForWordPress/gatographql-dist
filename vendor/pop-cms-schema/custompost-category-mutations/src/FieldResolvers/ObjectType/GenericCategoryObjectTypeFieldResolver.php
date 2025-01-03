<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\FieldResolvers\ObjectType\AbstractCategoryObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMutations\Module as CategoryMutationsModule;
use PoPCMSSchema\CategoryMutations\ModuleConfiguration as CategoryMutationsModuleConfiguration;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\GenericCategoryTermUpdateInputObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCategoryUpdateMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
/** @internal */
class GenericCategoryObjectTypeFieldResolver extends AbstractCategoryObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCategoryUpdateMutationPayloadObjectTypeResolver|null
     */
    private $genericCategoryUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMutationPayloadObjectTypeResolver|null
     */
    private $genericCategoryDeleteMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver|null
     */
    private $updateGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver|null
     */
    private $deleteGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver|null
     */
    private $payloadableUpdateGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermMutationResolver|null
     */
    private $payloadableDeleteGenericCategoryTermMutationResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\GenericCategoryTermUpdateInputObjectTypeResolver|null
     */
    private $genericCategoryTermUpdateInputObjectTypeResolver;
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
    }
    protected final function getGenericCategoryUpdateMutationPayloadObjectTypeResolver() : GenericCategoryUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategoryUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategoryUpdateMutationPayloadObjectTypeResolver */
            $genericCategoryUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryUpdateMutationPayloadObjectTypeResolver::class);
            $this->genericCategoryUpdateMutationPayloadObjectTypeResolver = $genericCategoryUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategoryUpdateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCategoryDeleteMutationPayloadObjectTypeResolver() : GenericCategoryDeleteMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategoryDeleteMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategoryDeleteMutationPayloadObjectTypeResolver */
            $genericCategoryDeleteMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryDeleteMutationPayloadObjectTypeResolver::class);
            $this->genericCategoryDeleteMutationPayloadObjectTypeResolver = $genericCategoryDeleteMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategoryDeleteMutationPayloadObjectTypeResolver;
    }
    protected final function getUpdateGenericCategoryTermMutationResolver() : UpdateGenericCategoryTermMutationResolver
    {
        if ($this->updateGenericCategoryTermMutationResolver === null) {
            /** @var UpdateGenericCategoryTermMutationResolver */
            $updateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(UpdateGenericCategoryTermMutationResolver::class);
            $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
        }
        return $this->updateGenericCategoryTermMutationResolver;
    }
    protected final function getDeleteGenericCategoryTermMutationResolver() : DeleteGenericCategoryTermMutationResolver
    {
        if ($this->deleteGenericCategoryTermMutationResolver === null) {
            /** @var DeleteGenericCategoryTermMutationResolver */
            $deleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(DeleteGenericCategoryTermMutationResolver::class);
            $this->deleteGenericCategoryTermMutationResolver = $deleteGenericCategoryTermMutationResolver;
        }
        return $this->deleteGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCategoryTermMutationResolver() : PayloadableUpdateGenericCategoryTermMutationResolver
    {
        if ($this->payloadableUpdateGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericCategoryTermMutationResolver */
            $payloadableUpdateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCategoryTermMutationResolver::class);
            $this->payloadableUpdateGenericCategoryTermMutationResolver = $payloadableUpdateGenericCategoryTermMutationResolver;
        }
        return $this->payloadableUpdateGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableDeleteGenericCategoryTermMutationResolver() : PayloadableDeleteGenericCategoryTermMutationResolver
    {
        if ($this->payloadableDeleteGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableDeleteGenericCategoryTermMutationResolver */
            $payloadableDeleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericCategoryTermMutationResolver::class);
            $this->payloadableDeleteGenericCategoryTermMutationResolver = $payloadableDeleteGenericCategoryTermMutationResolver;
        }
        return $this->payloadableDeleteGenericCategoryTermMutationResolver;
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
    protected final function getGenericCategoryTermUpdateInputObjectTypeResolver() : GenericCategoryTermUpdateInputObjectTypeResolver
    {
        if ($this->genericCategoryTermUpdateInputObjectTypeResolver === null) {
            /** @var GenericCategoryTermUpdateInputObjectTypeResolver */
            $genericCategoryTermUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryTermUpdateInputObjectTypeResolver::class);
            $this->genericCategoryTermUpdateInputObjectTypeResolver = $genericCategoryTermUpdateInputObjectTypeResolver;
        }
        return $this->genericCategoryTermUpdateInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCategoryObjectTypeResolver::class];
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'update':
                return ['input' => $this->getGenericCategoryTermUpdateInputObjectTypeResolver()];
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
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdateGenericCategoryTermMutationResolver() : $this->getUpdateGenericCategoryTermMutationResolver();
            case 'delete':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeleteGenericCategoryTermMutationResolver() : $this->getDeleteGenericCategoryTermMutationResolver();
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
                    return $this->getGenericCategoryObjectTypeResolver();
                case 'delete':
                    return $this->getBooleanScalarTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'update':
                return $this->getGenericCategoryUpdateMutationPayloadObjectTypeResolver();
            case 'delete':
                return $this->getGenericCategoryDeleteMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
