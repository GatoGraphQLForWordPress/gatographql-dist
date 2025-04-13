<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType\AbstractRootTagCRUDObjectTypeFieldResolver;
use PoPCMSSchema\TagMetaMutations\Module;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootSetGenericTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootGenericTagCRUDObjectTypeFieldResolver extends AbstractRootTagCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootSetGenericTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver;
    protected final function getGenericTagObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    protected final function getRootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver() : RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver */
            $rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver = $rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetGenericTagTermMetaMutationPayloadObjectTypeResolver() : RootSetGenericTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetGenericTagTermMetaMutationPayloadObjectTypeResolver */
            $rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetGenericTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver = $rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetGenericTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver() : RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver */
            $rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver = $rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddGenericTagTermMetaMutationPayloadObjectTypeResolver() : RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver */
            $rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver = $rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddGenericTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected function getTagEntityName() : string
    {
        return 'Tag';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        $tagEntityName = $this->getTagEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if ($usePayloadableTagMetaMutations) {
            switch ($fieldName) {
                case 'add' . $tagEntityName . 'Meta':
                case 'add' . $tagEntityName . 'Metas':
                case 'add' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootAddGenericTagTermMetaMutationPayloadObjectTypeResolver();
                case 'update' . $tagEntityName . 'Meta':
                case 'update' . $tagEntityName . 'Metas':
                case 'update' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $tagEntityName . 'Meta':
                case 'delete' . $tagEntityName . 'Metas':
                case 'delete' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver();
                case 'set' . $tagEntityName . 'Meta':
                case 'set' . $tagEntityName . 'Metas':
                case 'set' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetGenericTagTermMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'Meta':
            case 'add' . $tagEntityName . 'Metas':
            case 'update' . $tagEntityName . 'Meta':
            case 'update' . $tagEntityName . 'Metas':
            case 'delete' . $tagEntityName . 'Meta':
            case 'delete' . $tagEntityName . 'Metas':
            case 'set' . $tagEntityName . 'Meta':
            case 'set' . $tagEntityName . 'Metas':
                return $this->getGenericTagObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
