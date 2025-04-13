<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType\AbstractRootTagCRUDObjectTypeFieldResolver;
use PoPCMSSchema\TagMetaMutations\Module;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootAddPostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootSetPostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootPostTagCRUDObjectTypeFieldResolver extends AbstractRootTagCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootSetPostTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetPostTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootAddPostTagTermMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddPostTagTermMetaMutationPayloadObjectTypeResolver;
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
    }
    protected final function getRootDeletePostTagTermMetaMutationPayloadObjectTypeResolver() : RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver */
            $rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver = $rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePostTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetPostTagTermMetaMutationPayloadObjectTypeResolver() : RootSetPostTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetPostTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetPostTagTermMetaMutationPayloadObjectTypeResolver */
            $rootSetPostTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetPostTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetPostTagTermMetaMutationPayloadObjectTypeResolver = $rootSetPostTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetPostTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver() : RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver */
            $rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver = $rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddPostTagTermMetaMutationPayloadObjectTypeResolver() : RootAddPostTagTermMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddPostTagTermMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddPostTagTermMetaMutationPayloadObjectTypeResolver */
            $rootAddPostTagTermMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddPostTagTermMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddPostTagTermMetaMutationPayloadObjectTypeResolver = $rootAddPostTagTermMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddPostTagTermMetaMutationPayloadObjectTypeResolver;
    }
    protected function getTagEntityName() : string
    {
        return 'PostTag';
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
                    return $this->getRootAddPostTagTermMetaMutationPayloadObjectTypeResolver();
                case 'update' . $tagEntityName . 'Meta':
                case 'update' . $tagEntityName . 'Metas':
                case 'update' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver();
                case 'delete' . $tagEntityName . 'Meta':
                case 'delete' . $tagEntityName . 'Metas':
                case 'delete' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootDeletePostTagTermMetaMutationPayloadObjectTypeResolver();
                case 'set' . $tagEntityName . 'Meta':
                case 'set' . $tagEntityName . 'Metas':
                case 'set' . $tagEntityName . 'MetaMutationPayloadObjects':
                    return $this->getRootSetPostTagTermMetaMutationPayloadObjectTypeResolver();
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
                return $this->getPostTagObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
