<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module as CustomPostMetaMutationsModule;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration as CustomPostMetaMutationsModuleConfiguration;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $postDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $postCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $postUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $postSetMetaMutationPayloadObjectTypeResolver;
    protected final function getPostObjectTypeResolver() : PostObjectTypeResolver
    {
        if ($this->postObjectTypeResolver === null) {
            /** @var PostObjectTypeResolver */
            $postObjectTypeResolver = $this->instanceManager->getInstance(PostObjectTypeResolver::class);
            $this->postObjectTypeResolver = $postObjectTypeResolver;
        }
        return $this->postObjectTypeResolver;
    }
    protected final function getPostDeleteMetaMutationPayloadObjectTypeResolver() : PostDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostDeleteMetaMutationPayloadObjectTypeResolver */
            $postDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->postDeleteMetaMutationPayloadObjectTypeResolver = $postDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostAddMetaMutationPayloadObjectTypeResolver() : PostAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postCreateMutationPayloadObjectTypeResolver === null) {
            /** @var PostAddMetaMutationPayloadObjectTypeResolver */
            $postCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostAddMetaMutationPayloadObjectTypeResolver::class);
            $this->postCreateMutationPayloadObjectTypeResolver = $postCreateMutationPayloadObjectTypeResolver;
        }
        return $this->postCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getPostUpdateMetaMutationPayloadObjectTypeResolver() : PostUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostUpdateMetaMutationPayloadObjectTypeResolver */
            $postUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->postUpdateMetaMutationPayloadObjectTypeResolver = $postUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPostSetMetaMutationPayloadObjectTypeResolver() : PostSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->postSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PostSetMetaMutationPayloadObjectTypeResolver */
            $postSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostSetMetaMutationPayloadObjectTypeResolver::class);
            $this->postSetMetaMutationPayloadObjectTypeResolver = $postSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->postSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostObjectTypeResolver::class];
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
                    return $this->getPostObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getPostAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getPostDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getPostSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getPostUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
