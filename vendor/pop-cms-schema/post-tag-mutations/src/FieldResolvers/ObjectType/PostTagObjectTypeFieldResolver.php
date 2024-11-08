<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\PostTagTermUpdateInputObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostTagDeleteMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostTagUpdateMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\TagMutations\FieldResolvers\ObjectType\AbstractTagObjectTypeFieldResolver;
use PoPCMSSchema\TagMutations\Module as TagMutationsModule;
use PoPCMSSchema\TagMutations\ModuleConfiguration as TagMutationsModuleConfiguration;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
/** @internal */
class PostTagObjectTypeFieldResolver extends AbstractTagObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostTagUpdateMutationPayloadObjectTypeResolver|null
     */
    private $postTagUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostTagDeleteMutationPayloadObjectTypeResolver|null
     */
    private $postTagDeleteMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver|null
     */
    private $updatePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermMutationResolver|null
     */
    private $deletePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver|null
     */
    private $payloadableUpdatePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver|null
     */
    private $payloadableDeletePostTagTermMutationResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\PostTagTermUpdateInputObjectTypeResolver|null
     */
    private $postTagTermUpdateInputObjectTypeResolver;
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
    }
    protected final function getPostTagUpdateMutationPayloadObjectTypeResolver() : PostTagUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->postTagUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagUpdateMutationPayloadObjectTypeResolver */
            $postTagUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagUpdateMutationPayloadObjectTypeResolver::class);
            $this->postTagUpdateMutationPayloadObjectTypeResolver = $postTagUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->postTagUpdateMutationPayloadObjectTypeResolver;
    }
    protected final function getPostTagDeleteMutationPayloadObjectTypeResolver() : PostTagDeleteMutationPayloadObjectTypeResolver
    {
        if ($this->postTagDeleteMutationPayloadObjectTypeResolver === null) {
            /** @var PostTagDeleteMutationPayloadObjectTypeResolver */
            $postTagDeleteMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostTagDeleteMutationPayloadObjectTypeResolver::class);
            $this->postTagDeleteMutationPayloadObjectTypeResolver = $postTagDeleteMutationPayloadObjectTypeResolver;
        }
        return $this->postTagDeleteMutationPayloadObjectTypeResolver;
    }
    protected final function getUpdatePostTagTermMutationResolver() : UpdatePostTagTermMutationResolver
    {
        if ($this->updatePostTagTermMutationResolver === null) {
            /** @var UpdatePostTagTermMutationResolver */
            $updatePostTagTermMutationResolver = $this->instanceManager->getInstance(UpdatePostTagTermMutationResolver::class);
            $this->updatePostTagTermMutationResolver = $updatePostTagTermMutationResolver;
        }
        return $this->updatePostTagTermMutationResolver;
    }
    protected final function getDeletePostTagTermMutationResolver() : DeletePostTagTermMutationResolver
    {
        if ($this->deletePostTagTermMutationResolver === null) {
            /** @var DeletePostTagTermMutationResolver */
            $deletePostTagTermMutationResolver = $this->instanceManager->getInstance(DeletePostTagTermMutationResolver::class);
            $this->deletePostTagTermMutationResolver = $deletePostTagTermMutationResolver;
        }
        return $this->deletePostTagTermMutationResolver;
    }
    protected final function getPayloadableUpdatePostTagTermMutationResolver() : PayloadableUpdatePostTagTermMutationResolver
    {
        if ($this->payloadableUpdatePostTagTermMutationResolver === null) {
            /** @var PayloadableUpdatePostTagTermMutationResolver */
            $payloadableUpdatePostTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostTagTermMutationResolver::class);
            $this->payloadableUpdatePostTagTermMutationResolver = $payloadableUpdatePostTagTermMutationResolver;
        }
        return $this->payloadableUpdatePostTagTermMutationResolver;
    }
    protected final function getPayloadableDeletePostTagTermMutationResolver() : PayloadableDeletePostTagTermMutationResolver
    {
        if ($this->payloadableDeletePostTagTermMutationResolver === null) {
            /** @var PayloadableDeletePostTagTermMutationResolver */
            $payloadableDeletePostTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostTagTermMutationResolver::class);
            $this->payloadableDeletePostTagTermMutationResolver = $payloadableDeletePostTagTermMutationResolver;
        }
        return $this->payloadableDeletePostTagTermMutationResolver;
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
    protected final function getPostTagTermUpdateInputObjectTypeResolver() : PostTagTermUpdateInputObjectTypeResolver
    {
        if ($this->postTagTermUpdateInputObjectTypeResolver === null) {
            /** @var PostTagTermUpdateInputObjectTypeResolver */
            $postTagTermUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(PostTagTermUpdateInputObjectTypeResolver::class);
            $this->postTagTermUpdateInputObjectTypeResolver = $postTagTermUpdateInputObjectTypeResolver;
        }
        return $this->postTagTermUpdateInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostTagObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the post tag', 'tag-mutations');
            case 'delete':
                return $this->__('Delete the post tag', 'tag-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'update':
                return ['input' => $this->getPostTagTermUpdateInputObjectTypeResolver()];
            case 'delete':
                return [];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var TagMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(TagMutationsModule::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        switch ($fieldName) {
            case 'update':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdatePostTagTermMutationResolver() : $this->getUpdatePostTagTermMutationResolver();
            case 'delete':
                return $usePayloadableTagMutations ? $this->getPayloadableDeletePostTagTermMutationResolver() : $this->getDeletePostTagTermMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var TagMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(TagMutationsModule::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if (!$usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'update':
                    return $this->getPostTagObjectTypeResolver();
                case 'delete':
                    return $this->getBooleanScalarTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'update':
                return $this->getPostTagUpdateMutationPayloadObjectTypeResolver();
            case 'delete':
                return $this->getPostTagDeleteMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
