<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType\AbstractCategoryObjectTypeFieldResolver;
use PoPCMSSchema\CategoryMetaMutations\Module as CategoryMetaMutationsModule;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration as CategoryMetaMutationsModuleConfiguration;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategorySetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCategoryObjectTypeFieldResolver extends AbstractCategoryObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCategoryDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCategoryCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCategoryUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategorySetMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCategorySetMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
    }
    protected final function getGenericCategoryDeleteMetaMutationPayloadObjectTypeResolver() : GenericCategoryDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategoryDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategoryDeleteMetaMutationPayloadObjectTypeResolver */
            $genericCategoryDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCategoryDeleteMetaMutationPayloadObjectTypeResolver = $genericCategoryDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategoryDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCategoryAddMetaMutationPayloadObjectTypeResolver() : GenericCategoryAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategoryCreateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategoryAddMetaMutationPayloadObjectTypeResolver */
            $genericCategoryCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryAddMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCategoryCreateMutationPayloadObjectTypeResolver = $genericCategoryCreateMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategoryCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCategoryUpdateMetaMutationPayloadObjectTypeResolver() : GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategoryUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver */
            $genericCategoryUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCategoryUpdateMetaMutationPayloadObjectTypeResolver = $genericCategoryUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategoryUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCategorySetMetaMutationPayloadObjectTypeResolver() : GenericCategorySetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCategorySetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCategorySetMetaMutationPayloadObjectTypeResolver */
            $genericCategorySetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCategorySetMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCategorySetMetaMutationPayloadObjectTypeResolver = $genericCategorySetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCategorySetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCategoryObjectTypeResolver::class];
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
                    return $this->getGenericCategoryObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getGenericCategoryAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getGenericCategoryDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getGenericCategorySetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getGenericCategoryUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
