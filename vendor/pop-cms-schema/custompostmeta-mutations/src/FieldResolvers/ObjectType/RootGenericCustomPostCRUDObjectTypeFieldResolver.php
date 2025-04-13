<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractRootCustomPostCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootGenericCustomPostCRUDObjectTypeFieldResolver extends AbstractRootCustomPostCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    protected final function getRootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver() : RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver */
            $rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver = $rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver() : RootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver */
            $rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver = $rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver() : RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver */
            $rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver = $rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver() : RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver */
            $rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver = $rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver;
    }
    protected function getCustomPostEntityName() : string
    {
        return 'CustomPost';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if ($usePayloadableCustomPostMetaMutations) {
            switch ($fieldName) {
                case 'add' . $customPostEntityName . 'Meta':
                case 'add' . $customPostEntityName . 'Metas':
                case 'add' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver();
                case 'update' . $customPostEntityName . 'Meta':
                case 'update' . $customPostEntityName . 'Metas':
                case 'update' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $customPostEntityName . 'Meta':
                case 'delete' . $customPostEntityName . 'Metas':
                case 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver();
                case 'set' . $customPostEntityName . 'Meta':
                case 'set' . $customPostEntityName . 'Metas':
                case 'set' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetGenericCustomPostMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'Meta':
            case 'add' . $customPostEntityName . 'Metas':
            case 'update' . $customPostEntityName . 'Meta':
            case 'update' . $customPostEntityName . 'Metas':
            case 'delete' . $customPostEntityName . 'Meta':
            case 'delete' . $customPostEntityName . 'Metas':
            case 'set' . $customPostEntityName . 'Meta':
            case 'set' . $customPostEntityName . 'Metas':
                return $this->getGenericCustomPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
