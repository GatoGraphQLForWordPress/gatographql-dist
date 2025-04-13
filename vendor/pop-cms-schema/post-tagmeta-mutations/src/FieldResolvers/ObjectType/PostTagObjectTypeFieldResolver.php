<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType\AbstractTagObjectTypeFieldResolver;
use PoPCMSSchema\TagMetaMutations\Module as TagMetaMutationsModule;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration as TagMetaMutationsModuleConfiguration;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostTagObjectTypeFieldResolver extends AbstractTagObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $postTagDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $postTagCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $postTagUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\PostTagSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $postTagSetMetaMutationPayloadObjectTypeResolver;
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
    }
    protected final function getPostTagDeleteMetaMutationPayloadObjectTypeResolver() : PostTagDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postTagDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagDeleteMetaMutationPayloadObjectTypeResolver */
            $postTagDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->postTagDeleteMetaMutationPayloadObjectTypeResolver = $postTagDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postTagDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostTagAddMetaMutationPayloadObjectTypeResolver() : PostTagAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postTagCreateMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagAddMetaMutationPayloadObjectTypeResolver */
            $postTagCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagAddMetaMutationPayloadObjectTypeResolver::class);
            $this->postTagCreateMutationPayloadObjectTypeResolver = $postTagCreateMutationPayloadObjectTypeResolver;
        }
        return $this->postTagCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getPostTagUpdateMetaMutationPayloadObjectTypeResolver() : PostTagUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postTagUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagUpdateMetaMutationPayloadObjectTypeResolver */
            $postTagUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->postTagUpdateMetaMutationPayloadObjectTypeResolver = $postTagUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postTagUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostTagSetMetaMutationPayloadObjectTypeResolver() : PostTagSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postTagSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagSetMetaMutationPayloadObjectTypeResolver */
            $postTagSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagSetMetaMutationPayloadObjectTypeResolver::class);
            $this->postTagSetMetaMutationPayloadObjectTypeResolver = $postTagSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postTagSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostTagObjectTypeResolver::class];
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
                    return $this->getPostTagObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getPostTagAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getPostTagDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getPostTagSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getPostTagUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
