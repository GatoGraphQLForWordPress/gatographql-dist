<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver;
use PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootAddCommentToCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootReplyCommentInputObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootReplyCommentMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
class RootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver|null
     */
    private $addCommentToCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootAddCommentToCustomPostInputObjectTypeResolver|null
     */
    private $rootAddCommentToCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootReplyCommentInputObjectTypeResolver|null
     */
    private $rootReplyCommentInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootAddCommentToCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootReplyCommentMutationPayloadObjectTypeResolver|null
     */
    private $rootReplyCommentMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver|null
     */
    private $payloadableAddCommentToCustomPostMutationResolver;
    public final function setCommentObjectTypeResolver(CommentObjectTypeResolver $commentObjectTypeResolver) : void
    {
        $this->commentObjectTypeResolver = $commentObjectTypeResolver;
    }
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    public final function setAddCommentToCustomPostMutationResolver(AddCommentToCustomPostMutationResolver $addCommentToCustomPostMutationResolver) : void
    {
        $this->addCommentToCustomPostMutationResolver = $addCommentToCustomPostMutationResolver;
    }
    protected final function getAddCommentToCustomPostMutationResolver() : AddCommentToCustomPostMutationResolver
    {
        if ($this->addCommentToCustomPostMutationResolver === null) {
            /** @var AddCommentToCustomPostMutationResolver */
            $addCommentToCustomPostMutationResolver = $this->instanceManager->getInstance(AddCommentToCustomPostMutationResolver::class);
            $this->addCommentToCustomPostMutationResolver = $addCommentToCustomPostMutationResolver;
        }
        return $this->addCommentToCustomPostMutationResolver;
    }
    public final function setRootAddCommentToCustomPostInputObjectTypeResolver(RootAddCommentToCustomPostInputObjectTypeResolver $rootAddCommentToCustomPostInputObjectTypeResolver) : void
    {
        $this->rootAddCommentToCustomPostInputObjectTypeResolver = $rootAddCommentToCustomPostInputObjectTypeResolver;
    }
    protected final function getRootAddCommentToCustomPostInputObjectTypeResolver() : RootAddCommentToCustomPostInputObjectTypeResolver
    {
        if ($this->rootAddCommentToCustomPostInputObjectTypeResolver === null) {
            /** @var RootAddCommentToCustomPostInputObjectTypeResolver */
            $rootAddCommentToCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddCommentToCustomPostInputObjectTypeResolver::class);
            $this->rootAddCommentToCustomPostInputObjectTypeResolver = $rootAddCommentToCustomPostInputObjectTypeResolver;
        }
        return $this->rootAddCommentToCustomPostInputObjectTypeResolver;
    }
    public final function setRootReplyCommentInputObjectTypeResolver(RootReplyCommentInputObjectTypeResolver $rootReplyCommentInputObjectTypeResolver) : void
    {
        $this->rootReplyCommentInputObjectTypeResolver = $rootReplyCommentInputObjectTypeResolver;
    }
    protected final function getRootReplyCommentInputObjectTypeResolver() : RootReplyCommentInputObjectTypeResolver
    {
        if ($this->rootReplyCommentInputObjectTypeResolver === null) {
            /** @var RootReplyCommentInputObjectTypeResolver */
            $rootReplyCommentInputObjectTypeResolver = $this->instanceManager->getInstance(RootReplyCommentInputObjectTypeResolver::class);
            $this->rootReplyCommentInputObjectTypeResolver = $rootReplyCommentInputObjectTypeResolver;
        }
        return $this->rootReplyCommentInputObjectTypeResolver;
    }
    public final function setRootAddCommentToCustomPostMutationPayloadObjectTypeResolver(RootAddCommentToCustomPostMutationPayloadObjectTypeResolver $rootAddCommentToCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootAddCommentToCustomPostMutationPayloadObjectTypeResolver = $rootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddCommentToCustomPostMutationPayloadObjectTypeResolver() : RootAddCommentToCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddCommentToCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddCommentToCustomPostMutationPayloadObjectTypeResolver */
            $rootAddCommentToCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddCommentToCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootAddCommentToCustomPostMutationPayloadObjectTypeResolver = $rootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
    }
    public final function setRootReplyCommentMutationPayloadObjectTypeResolver(RootReplyCommentMutationPayloadObjectTypeResolver $rootReplyCommentMutationPayloadObjectTypeResolver) : void
    {
        $this->rootReplyCommentMutationPayloadObjectTypeResolver = $rootReplyCommentMutationPayloadObjectTypeResolver;
    }
    protected final function getRootReplyCommentMutationPayloadObjectTypeResolver() : RootReplyCommentMutationPayloadObjectTypeResolver
    {
        if ($this->rootReplyCommentMutationPayloadObjectTypeResolver === null) {
            /** @var RootReplyCommentMutationPayloadObjectTypeResolver */
            $rootReplyCommentMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootReplyCommentMutationPayloadObjectTypeResolver::class);
            $this->rootReplyCommentMutationPayloadObjectTypeResolver = $rootReplyCommentMutationPayloadObjectTypeResolver;
        }
        return $this->rootReplyCommentMutationPayloadObjectTypeResolver;
    }
    public final function setPayloadableAddCommentToCustomPostMutationResolver(PayloadableAddCommentToCustomPostMutationResolver $payloadableAddCommentToCustomPostMutationResolver) : void
    {
        $this->payloadableAddCommentToCustomPostMutationResolver = $payloadableAddCommentToCustomPostMutationResolver;
    }
    protected final function getPayloadableAddCommentToCustomPostMutationResolver() : PayloadableAddCommentToCustomPostMutationResolver
    {
        if ($this->payloadableAddCommentToCustomPostMutationResolver === null) {
            /** @var PayloadableAddCommentToCustomPostMutationResolver */
            $payloadableAddCommentToCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableAddCommentToCustomPostMutationResolver::class);
            $this->payloadableAddCommentToCustomPostMutationResolver = $payloadableAddCommentToCustomPostMutationResolver;
        }
        return $this->payloadableAddCommentToCustomPostMutationResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        /** @var EngineModuleConfiguration */
        $moduleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        if ($moduleConfiguration->disableRedundantRootTypeMutationFields()) {
            return [];
        }
        return ['addCommentToCustomPost', 'replyComment'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addCommentToCustomPost':
                return $this->__('Add a comment to a custom post', 'comment-mutations');
            case 'replyComment':
                return $this->__('Reply a comment with another comment', 'comment-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMutations = $moduleConfiguration->usePayloadableCommentMutations();
        if (!$usePayloadableCommentMutations) {
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'addCommentToCustomPost':
            case 'replyComment':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'addCommentToCustomPost':
                return [MutationInputProperties::INPUT => $this->getRootAddCommentToCustomPostInputObjectTypeResolver()];
            case 'replyComment':
                return [MutationInputProperties::INPUT => $this->getRootReplyCommentInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ($fieldArgName) {
            case MutationInputProperties::INPUT:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMutations = $moduleConfiguration->usePayloadableCommentMutations();
        switch ($fieldName) {
            case 'addCommentToCustomPost':
            case 'replyComment':
                return $usePayloadableCommentMutations ? $this->getPayloadableAddCommentToCustomPostMutationResolver() : $this->getAddCommentToCustomPostMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMutations = $moduleConfiguration->usePayloadableCommentMutations();
        if ($usePayloadableCommentMutations) {
            switch ($fieldName) {
                case 'addCommentToCustomPost':
                    return $this->getRootAddCommentToCustomPostMutationPayloadObjectTypeResolver();
                case 'replyComment':
                    return $this->getRootReplyCommentMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addCommentToCustomPost':
            case 'replyComment':
                return $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
