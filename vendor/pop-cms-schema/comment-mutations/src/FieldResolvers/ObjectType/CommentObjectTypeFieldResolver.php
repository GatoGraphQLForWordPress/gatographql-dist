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
use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentReplyInputObjectTypeResolver;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentReplyMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\Constants\MutationInputProperties as SchemaCommonsMutationInputProperties;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoP\ComponentModel\App;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use stdClass;
/** @internal */
class CommentObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
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
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentReplyInputObjectTypeResolver|null
     */
    private $commentReplyInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentReplyMutationPayloadObjectTypeResolver|null
     */
    private $commentReplyMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver|null
     */
    private $payloadableAddCommentToCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableAddCommentToCustomPostBulkOperationMutationResolver;
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
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
    protected final function getAddCommentToCustomPostMutationResolver() : AddCommentToCustomPostMutationResolver
    {
        if ($this->addCommentToCustomPostMutationResolver === null) {
            /** @var AddCommentToCustomPostMutationResolver */
            $addCommentToCustomPostMutationResolver = $this->instanceManager->getInstance(AddCommentToCustomPostMutationResolver::class);
            $this->addCommentToCustomPostMutationResolver = $addCommentToCustomPostMutationResolver;
        }
        return $this->addCommentToCustomPostMutationResolver;
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
    protected final function getCommentReplyInputObjectTypeResolver() : CommentReplyInputObjectTypeResolver
    {
        if ($this->commentReplyInputObjectTypeResolver === null) {
            /** @var CommentReplyInputObjectTypeResolver */
            $commentReplyInputObjectTypeResolver = $this->instanceManager->getInstance(CommentReplyInputObjectTypeResolver::class);
            $this->commentReplyInputObjectTypeResolver = $commentReplyInputObjectTypeResolver;
        }
        return $this->commentReplyInputObjectTypeResolver;
    }
    protected final function getCommentReplyMutationPayloadObjectTypeResolver() : CommentReplyMutationPayloadObjectTypeResolver
    {
        if ($this->commentReplyMutationPayloadObjectTypeResolver === null) {
            /** @var CommentReplyMutationPayloadObjectTypeResolver */
            $commentReplyMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentReplyMutationPayloadObjectTypeResolver::class);
            $this->commentReplyMutationPayloadObjectTypeResolver = $commentReplyMutationPayloadObjectTypeResolver;
        }
        return $this->commentReplyMutationPayloadObjectTypeResolver;
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
        return [CommentObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['reply', 'replyWithComments'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'reply':
                return $this->__('Reply a comment with another comment', 'comment-mutations');
            case 'replyWithComments':
                return $this->__('Reply a comment with other comments', 'comment-mutations');
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
                case 'reply':
                    return SchemaTypeModifiers::NONE;
                case 'replyWithComments':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'reply':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'replyWithComments':
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
            case 'reply':
                return [MutationInputProperties::INPUT => $this->getCommentReplyInputObjectTypeResolver()];
            case 'replyWithComments':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getCommentReplyInputObjectTypeResolver());
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['reply' => MutationInputProperties::INPUT]:
                return SchemaTypeModifiers::MANDATORY;
            case ['replyWithComments' => SchemaCommonsMutationInputProperties::INPUTS]:
                return SchemaTypeModifiers::MANDATORY | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * Validated the mutation on the object because the ID
     * is obtained from the same object, so it's not originally
     * present in the field argument in the query
     */
    public function validateMutationOnObject(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : bool
    {
        switch ($fieldName) {
            case 'reply':
            case 'replyWithComments':
                return \true;
            default:
                return parent::validateMutationOnObject($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @param array<string,mixed> $fieldArgsForMutationForObject
     * @return array<string,mixed>
     */
    public function prepareFieldArgsForMutationForObject(array $fieldArgsForMutationForObject, ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field, object $object) : array
    {
        $fieldArgsForMutationForObject = parent::prepareFieldArgsForMutationForObject($fieldArgsForMutationForObject, $objectTypeResolver, $field, $object);
        $comment = $object;
        switch ($field->getName()) {
            case 'reply':
                /** @var stdClass */
                $input =& $fieldArgsForMutationForObject[MutationInputProperties::INPUT];
                $input->{MutationInputProperties::CUSTOMPOST_ID} = $this->getCommentTypeAPI()->getCommentPostID($comment);
                $input->{MutationInputProperties::PARENT_COMMENT_ID} = $objectTypeResolver->getID($comment);
                break;
            case 'replyWithComments':
                /** @var stdClass[] */
                $inputs = $fieldArgsForMutationForObject[SchemaCommonsMutationInputProperties::INPUTS];
                $customPostID = $this->getCommentTypeAPI()->getCommentPostID($comment);
                $parentCommentID = $objectTypeResolver->getID($comment);
                foreach ($inputs as &$input) {
                    $input->{MutationInputProperties::CUSTOMPOST_ID} = $customPostID;
                    $input->{MutationInputProperties::PARENT_COMMENT_ID} = $parentCommentID;
                }
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMutations = $moduleConfiguration->usePayloadableCommentMutations();
        switch ($fieldName) {
            case 'reply':
                return $usePayloadableCommentMutations ? $this->getPayloadableAddCommentToCustomPostMutationResolver() : $this->getAddCommentToCustomPostMutationResolver();
            case 'replyWithComments':
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
        switch ($fieldName) {
            case 'reply':
            case 'replyWithComments':
                return $usePayloadableCommentMutations ? $this->getCommentReplyMutationPayloadObjectTypeResolver() : $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
