<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module as CustomPostMetaMutationsModule;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration as CustomPostMetaMutationsModuleConfiguration;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $genericCustomPostSetMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    protected final function getGenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver() : GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver */
            $genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver = $genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCustomPostAddMetaMutationPayloadObjectTypeResolver() : GenericCustomPostAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostCreateMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostAddMetaMutationPayloadObjectTypeResolver */
            $genericCustomPostCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostAddMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostCreateMutationPayloadObjectTypeResolver = $genericCustomPostCreateMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver() : GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver */
            $genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver = $genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getGenericCustomPostSetMetaMutationPayloadObjectTypeResolver() : GenericCustomPostSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->genericCustomPostSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var GenericCustomPostSetMetaMutationPayloadObjectTypeResolver */
            $genericCustomPostSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostSetMetaMutationPayloadObjectTypeResolver::class);
            $this->genericCustomPostSetMetaMutationPayloadObjectTypeResolver = $genericCustomPostSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->genericCustomPostSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMetaMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if (!$usePayloadableCustomPostMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getGenericCustomPostObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getGenericCustomPostAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getGenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getGenericCustomPostSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getGenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
