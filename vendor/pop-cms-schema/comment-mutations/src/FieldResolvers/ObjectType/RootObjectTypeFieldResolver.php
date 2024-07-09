<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver;
use PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootAddCommentToCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootReplyCommentInputObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootAddCommentToCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\RootReplyCommentMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
/** @internal */
class RootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver|null
     */
    private $addCommentToCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostBulkOperationMutationResolver|null
     */
    private $addCommentToCustomPostBulkOperationMutationResolver;
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
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableAddCommentToCustomPostBulkOperationMutationResolver;
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
    public final function setAddCommentToCustomPostBulkOperationMutationResolver(AddCommentToCustomPostBulkOperationMutationResolver $addCommentToCustomPostBulkOperationMutationResolver) : void
    {
        $this->addCommentToCustomPostBulkOperationMutationResolver = $addCommentToCustomPostBulkOperationMutationResolver;
    }
    protected final function getAddCommentToCustomPostBulkOperationMutationResolver() : AddCommentToCustomPostBulkOperationMutationResolver
    {
        if ($this->addCommentToCustomPostBulkOperationMutationResolver === null) {
            /** @var AddCommentToCustomPostBulkOperationMutationResolver */
            $addCommentToCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(AddCommentToCustomPostBulkOperationMutationResolver::class);
            $this->addCommentToCustomPostBulkOperationMutationResolver = $addCommentToCustomPostBulkOperationMutationResolver;
        }
        return $this->addCommentToCustomPostBulkOperationMutationResolver;
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
    public final function setPayloadableAddCommentToCustomPostBulkOperationMutationResolver(PayloadableAddCommentToCustomPostBulkOperationMutationResolver $payloadableAddCommentToCustomPostBulkOperationMutationResolver) : void
    {
        $this->payloadableAddCommentToCustomPostBulkOperationMutationResolver = $payloadableAddCommentToCustomPostBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddCommentToCustomPostBulkOperationMutationResolver() : PayloadableAddCommentToCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableAddCommentToCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableAddCommentToCustomPostBulkOperationMutationResolver */
            $payloadableAddCommentToCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddCommentToCustomPostBulkOperationMutationResolver::class);
            $this->payloadableAddCommentToCustomPostBulkOperationMutationResolver = $payloadableAddCommentToCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableAddCommentToCustomPostBulkOperationMutationResolver;
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
        $engineModuleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        if ($engineModuleConfiguration->disableRedundantRootTypeMutationFields()) {
            return [];
        }
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableCommentMutations = $moduleConfiguration->addFieldsToQueryPayloadableCommentMutations();
        return \array_merge(['addCommentToCustomPost', 'addCommentToCustomPosts', 'replyComment', 'replyComments'], $addFieldsToQueryPayloadableCommentMutations ? ['addCommentToCustomPostMutationPayloadObjects', 'replyCommentMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addCommentToCustomPost':
                return $this->__('Add a comment to a custom post', 'comment-mutations');
            case 'addCommentToCustomPosts':
                return $this->__('Add comments to a custom post', 'comment-mutations');
            case 'replyComment':
                return $this->__('Reply a comment with another comment', 'comment-mutations');
            case 'replyComments':
                return $this->__('Reply comment with other comments', 'comment-mutations');
            case 'addCommentToCustomPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addCommentToCustomPost` mutation', 'comment-mutations');
            case 'replyCommentMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `replyComment` mutation', 'comment-mutations');
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
            switch ($fieldName) {
                case 'addCommentToCustomPost':
                case 'replyComment':
                    return SchemaTypeModifiers::NONE;
                case 'addCommentToCustomPosts':
                case 'replyComments':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['addCommentToCustomPostMutationPayloadObjects', 'replyCommentMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'addCommentToCustomPost':
            case 'replyComment':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'addCommentToCustomPosts':
            case 'replyComments':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
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
            case 'addCommentToCustomPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddCommentToCustomPostInputObjectTypeResolver());
            case 'replyComment':
                return [MutationInputProperties::INPUT => $this->getRootReplyCommentInputObjectTypeResolver()];
            case 'replyComments':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootReplyCommentInputObjectTypeResolver());
            case 'addCommentToCustomPostMutationPayloadObjects':
            case 'replyCommentMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['addCommentToCustomPostMutationPayloadObjects', 'replyCommentMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['addCommentToCustomPosts', 'replyComments'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['addCommentToCustomPost' => MutationInputProperties::INPUT]:
            case ['replyComment' => MutationInputProperties::INPUT]:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName)
    {
        if (\in_array($fieldName, ['addCommentToCustomPosts', 'replyComments'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
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
            case 'addCommentToCustomPosts':
            case 'replyComments':
                return $usePayloadableCommentMutations ? $this->getPayloadableAddCommentToCustomPostBulkOperationMutationResolver() : $this->getAddCommentToCustomPostBulkOperationMutationResolver();
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
                case 'addCommentToCustomPosts':
                case 'addCommentToCustomPostMutationPayloadObjects':
                    return $this->getRootAddCommentToCustomPostMutationPayloadObjectTypeResolver();
                case 'replyComment':
                case 'replyComments':
                case 'replyCommentMutationPayloadObjects':
                    return $this->getRootReplyCommentMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addCommentToCustomPost':
            case 'addCommentToCustomPosts':
            case 'replyComment':
            case 'replyComments':
                return $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'addCommentToCustomPostMutationPayloadObjects':
            case 'replyCommentMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
