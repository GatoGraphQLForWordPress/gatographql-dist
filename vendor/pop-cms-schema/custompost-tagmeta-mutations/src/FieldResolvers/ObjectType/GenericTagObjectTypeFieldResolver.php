<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType\AbstractTagObjectTypeFieldResolver;
use PoPCMSSchema\TagMetaMutations\Module as TagMetaMutationsModule;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration as TagMetaMutationsModuleConfiguration;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTagObjectTypeFieldResolver extends AbstractTagObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericTagDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericTagCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericTagUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\GenericTagSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericTagSetMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericTagObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    protected final function getGenericTagDeleteMetaMutationPayloadObjectTypeResolver() : GenericTagDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagDeleteMetaMutationPayloadObjectTypeResolver */
            $genericTagDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->genericTagDeleteMetaMutationPayloadObjectTypeResolver = $genericTagDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericTagAddMetaMutationPayloadObjectTypeResolver() : GenericTagAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagCreateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagAddMetaMutationPayloadObjectTypeResolver */
            $genericTagCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagAddMetaMutationPayloadObjectTypeResolver::class);
            $this->genericTagCreateMutationPayloadObjectTypeResolver = $genericTagCreateMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericTagUpdateMetaMutationPayloadObjectTypeResolver() : GenericTagUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagUpdateMetaMutationPayloadObjectTypeResolver */
            $genericTagUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->genericTagUpdateMetaMutationPayloadObjectTypeResolver = $genericTagUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericTagSetMetaMutationPayloadObjectTypeResolver() : GenericTagSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericTagSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericTagSetMetaMutationPayloadObjectTypeResolver */
            $genericTagSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericTagSetMetaMutationPayloadObjectTypeResolver::class);
            $this->genericTagSetMetaMutationPayloadObjectTypeResolver = $genericTagSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericTagSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var TagMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(TagMetaMutationsModule::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if (!$usePayloadableTagMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getGenericTagObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getGenericTagAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getGenericTagDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getGenericTagSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getGenericTagUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
