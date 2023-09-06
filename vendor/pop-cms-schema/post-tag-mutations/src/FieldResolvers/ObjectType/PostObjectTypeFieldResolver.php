<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableSetTagsOnPostMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\SetTagsOnPostMutationResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\PostSetTagsInputObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostSetTagsMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
class PostObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\SetTagsOnPostMutationResolver|null
     */
    private $setTagsOnPostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\PostSetTagsInputObjectTypeResolver|null
     */
    private $postSetTagsInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableSetTagsOnPostMutationResolver|null
     */
    private $payloadableSetTagsOnPostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\PostSetTagsMutationPayloadObjectTypeResolver|null
     */
    private $postSetTagsMutationPayloadObjectTypeResolver;
    public final function setPostObjectTypeResolver(PostObjectTypeResolver $postObjectTypeResolver) : void
    {
        $this->postObjectTypeResolver = $postObjectTypeResolver;
    }
    protected final function getPostObjectTypeResolver() : PostObjectTypeResolver
    {
        if ($this->postObjectTypeResolver === null) {
            /** @var PostObjectTypeResolver */
            $postObjectTypeResolver = $this->instanceManager->getInstance(PostObjectTypeResolver::class);
            $this->postObjectTypeResolver = $postObjectTypeResolver;
        }
        return $this->postObjectTypeResolver;
    }
    public final function setSetTagsOnPostMutationResolver(SetTagsOnPostMutationResolver $setTagsOnPostMutationResolver) : void
    {
        $this->setTagsOnPostMutationResolver = $setTagsOnPostMutationResolver;
    }
    protected final function getSetTagsOnPostMutationResolver() : SetTagsOnPostMutationResolver
    {
        if ($this->setTagsOnPostMutationResolver === null) {
            /** @var SetTagsOnPostMutationResolver */
            $setTagsOnPostMutationResolver = $this->instanceManager->getInstance(SetTagsOnPostMutationResolver::class);
            $this->setTagsOnPostMutationResolver = $setTagsOnPostMutationResolver;
        }
        return $this->setTagsOnPostMutationResolver;
    }
    public final function setPostSetTagsInputObjectTypeResolver(PostSetTagsInputObjectTypeResolver $postSetTagsInputObjectTypeResolver) : void
    {
        $this->postSetTagsInputObjectTypeResolver = $postSetTagsInputObjectTypeResolver;
    }
    protected final function getPostSetTagsInputObjectTypeResolver() : AbstractSetTagsOnCustomPostInputObjectTypeResolver
    {
        if ($this->postSetTagsInputObjectTypeResolver === null) {
            /** @var PostSetTagsInputObjectTypeResolver */
            $postSetTagsInputObjectTypeResolver = $this->instanceManager->getInstance(PostSetTagsInputObjectTypeResolver::class);
            $this->postSetTagsInputObjectTypeResolver = $postSetTagsInputObjectTypeResolver;
        }
        return $this->postSetTagsInputObjectTypeResolver;
    }
    public final function setPayloadableSetTagsOnPostMutationResolver(PayloadableSetTagsOnPostMutationResolver $payloadableSetTagsOnPostMutationResolver) : void
    {
        $this->payloadableSetTagsOnPostMutationResolver = $payloadableSetTagsOnPostMutationResolver;
    }
    protected final function getPayloadableSetTagsOnPostMutationResolver() : PayloadableSetTagsOnPostMutationResolver
    {
        if ($this->payloadableSetTagsOnPostMutationResolver === null) {
            /** @var PayloadableSetTagsOnPostMutationResolver */
            $payloadableSetTagsOnPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagsOnPostMutationResolver::class);
            $this->payloadableSetTagsOnPostMutationResolver = $payloadableSetTagsOnPostMutationResolver;
        }
        return $this->payloadableSetTagsOnPostMutationResolver;
    }
    public final function setPostSetTagsMutationPayloadObjectTypeResolver(PostSetTagsMutationPayloadObjectTypeResolver $postSetTagsMutationPayloadObjectTypeResolver) : void
    {
        $this->postSetTagsMutationPayloadObjectTypeResolver = $postSetTagsMutationPayloadObjectTypeResolver;
    }
    protected final function getPostSetTagsMutationPayloadObjectTypeResolver() : PostSetTagsMutationPayloadObjectTypeResolver
    {
        if ($this->postSetTagsMutationPayloadObjectTypeResolver === null) {
            /** @var PostSetTagsMutationPayloadObjectTypeResolver */
            $postSetTagsMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PostSetTagsMutationPayloadObjectTypeResolver::class);
            $this->postSetTagsMutationPayloadObjectTypeResolver = $postSetTagsMutationPayloadObjectTypeResolver;
        }
        return $this->postSetTagsMutationPayloadObjectTypeResolver;
    }
    public function getCustomPostObjectTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getPostObjectTypeResolver();
    }
    public function getSetTagsMutationResolver() : MutationResolverInterface
    {
        return $this->getSetTagsOnPostMutationResolver();
    }
    public function getCustomPostSetTagsInputObjectTypeResolver() : AbstractSetTagsOnCustomPostInputObjectTypeResolver
    {
        return $this->getPostSetTagsInputObjectTypeResolver();
    }
    protected function getCustomPostSetTagsMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface
    {
        return $this->getPostSetTagsMutationPayloadObjectTypeResolver();
    }
    public function getPayloadableSetTagsMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnPostMutationResolver();
    }
    protected function getEntityName() : string
    {
        return $this->__('post', 'post-tag-mutations');
    }
}
