<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractRootCustomPostCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootAddPostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootDeletePostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootSetPostMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootUpdatePostMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/**
 * Made abstract to not initialize class (it's disabled)
 * @internal
 */
abstract class RootPostCRUDObjectTypeFieldResolver extends AbstractRootCustomPostCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootDeletePostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootSetPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetPostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootUpdatePostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\RootAddPostMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddPostMetaMutationPayloadObjectTypeResolver;
    protected final function getPostObjectTypeResolver() : PostObjectTypeResolver
    {
        if ($this->postObjectTypeResolver === null) {
            /** @var PostObjectTypeResolver */
            $postObjectTypeResolver = $this->instanceManager->getInstance(PostObjectTypeResolver::class);
            $this->postObjectTypeResolver = $postObjectTypeResolver;
        }
        return $this->postObjectTypeResolver;
    }
    protected final function getRootDeletePostMetaMutationPayloadObjectTypeResolver() : RootDeletePostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePostMetaMutationPayloadObjectTypeResolver */
            $rootDeletePostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePostMetaMutationPayloadObjectTypeResolver = $rootDeletePostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetPostMetaMutationPayloadObjectTypeResolver() : RootSetPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetPostMetaMutationPayloadObjectTypeResolver */
            $rootSetPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetPostMetaMutationPayloadObjectTypeResolver = $rootSetPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetPostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostMetaMutationPayloadObjectTypeResolver() : RootUpdatePostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostMetaMutationPayloadObjectTypeResolver */
            $rootUpdatePostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostMetaMutationPayloadObjectTypeResolver = $rootUpdatePostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddPostMetaMutationPayloadObjectTypeResolver() : RootAddPostMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddPostMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddPostMetaMutationPayloadObjectTypeResolver */
            $rootAddPostMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddPostMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddPostMetaMutationPayloadObjectTypeResolver = $rootAddPostMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddPostMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * Disable because we don't need `addPostMeta` and
     * `addCustomPostMeta`, it's too confusing
     */
    public function isServiceEnabled() : bool
    {
        return \false;
    }
    protected function getCustomPostEntityName() : string
    {
        return 'Post';
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
                    return $this->getRootAddPostMetaMutationPayloadObjectTypeResolver();
                case 'update' . $customPostEntityName . 'Meta':
                case 'update' . $customPostEntityName . 'Metas':
                case 'update' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdatePostMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $customPostEntityName . 'Meta':
                case 'delete' . $customPostEntityName . 'Metas':
                case 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeletePostMetaMutationPayloadObjectTypeResolver();
                case 'set' . $customPostEntityName . 'Meta':
                case 'set' . $customPostEntityName . 'Metas':
                case 'set' . $customPostEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetPostMetaMutationPayloadObjectTypeResolver();
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
                return $this->getPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
