<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\FieldResolvers\ObjectType;

use DateTime;
use PoPCMSSchema\Comments\Module;
use PoPCMSSchema\Comments\ModuleConfiguration;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentResponsePaginationInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentResponsesFilterInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeHelpers\CustomPostUnionTypeHelpers;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\CommonFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class CommentObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver|null
     */
    private $htmlScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver|null
     */
    private $emailScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver|null
     */
    private $dateTimeScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver|null
     */
    private $commentStatusEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface|null
     */
    private $dateFormatter;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentResponsesFilterInputObjectTypeResolver|null
     */
    private $commentResponsesFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentResponsePaginationInputObjectTypeResolver|null
     */
    private $commentResponsePaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver|null
     */
    private $commentSortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver|null
     */
    private $commentTypeEnumTypeResolver;
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getHTMLScalarTypeResolver() : HTMLScalarTypeResolver
    {
        if ($this->htmlScalarTypeResolver === null) {
            /** @var HTMLScalarTypeResolver */
            $htmlScalarTypeResolver = $this->instanceManager->getInstance(HTMLScalarTypeResolver::class);
            $this->htmlScalarTypeResolver = $htmlScalarTypeResolver;
        }
        return $this->htmlScalarTypeResolver;
    }
    protected final function getURLScalarTypeResolver() : URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
    }
    protected final function getEmailScalarTypeResolver() : EmailScalarTypeResolver
    {
        if ($this->emailScalarTypeResolver === null) {
            /** @var EmailScalarTypeResolver */
            $emailScalarTypeResolver = $this->instanceManager->getInstance(EmailScalarTypeResolver::class);
            $this->emailScalarTypeResolver = $emailScalarTypeResolver;
        }
        return $this->emailScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
    protected final function getDateTimeScalarTypeResolver() : DateTimeScalarTypeResolver
    {
        if ($this->dateTimeScalarTypeResolver === null) {
            /** @var DateTimeScalarTypeResolver */
            $dateTimeScalarTypeResolver = $this->instanceManager->getInstance(DateTimeScalarTypeResolver::class);
            $this->dateTimeScalarTypeResolver = $dateTimeScalarTypeResolver;
        }
        return $this->dateTimeScalarTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
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
    protected final function getCommentStatusEnumTypeResolver() : CommentStatusEnumTypeResolver
    {
        if ($this->commentStatusEnumTypeResolver === null) {
            /** @var CommentStatusEnumTypeResolver */
            $commentStatusEnumTypeResolver = $this->instanceManager->getInstance(CommentStatusEnumTypeResolver::class);
            $this->commentStatusEnumTypeResolver = $commentStatusEnumTypeResolver;
        }
        return $this->commentStatusEnumTypeResolver;
    }
    protected final function getDateFormatter() : DateFormatterInterface
    {
        if ($this->dateFormatter === null) {
            /** @var DateFormatterInterface */
            $dateFormatter = $this->instanceManager->getInstance(DateFormatterInterface::class);
            $this->dateFormatter = $dateFormatter;
        }
        return $this->dateFormatter;
    }
    protected final function getCommentResponsesFilterInputObjectTypeResolver() : CommentResponsesFilterInputObjectTypeResolver
    {
        if ($this->commentResponsesFilterInputObjectTypeResolver === null) {
            /** @var CommentResponsesFilterInputObjectTypeResolver */
            $commentResponsesFilterInputObjectTypeResolver = $this->instanceManager->getInstance(CommentResponsesFilterInputObjectTypeResolver::class);
            $this->commentResponsesFilterInputObjectTypeResolver = $commentResponsesFilterInputObjectTypeResolver;
        }
        return $this->commentResponsesFilterInputObjectTypeResolver;
    }
    protected final function getCommentResponsePaginationInputObjectTypeResolver() : CommentResponsePaginationInputObjectTypeResolver
    {
        if ($this->commentResponsePaginationInputObjectTypeResolver === null) {
            /** @var CommentResponsePaginationInputObjectTypeResolver */
            $commentResponsePaginationInputObjectTypeResolver = $this->instanceManager->getInstance(CommentResponsePaginationInputObjectTypeResolver::class);
            $this->commentResponsePaginationInputObjectTypeResolver = $commentResponsePaginationInputObjectTypeResolver;
        }
        return $this->commentResponsePaginationInputObjectTypeResolver;
    }
    protected final function getCommentSortInputObjectTypeResolver() : CommentSortInputObjectTypeResolver
    {
        if ($this->commentSortInputObjectTypeResolver === null) {
            /** @var CommentSortInputObjectTypeResolver */
            $commentSortInputObjectTypeResolver = $this->instanceManager->getInstance(CommentSortInputObjectTypeResolver::class);
            $this->commentSortInputObjectTypeResolver = $commentSortInputObjectTypeResolver;
        }
        return $this->commentSortInputObjectTypeResolver;
    }
    protected final function getCommentTypeEnumTypeResolver() : CommentTypeEnumTypeResolver
    {
        if ($this->commentTypeEnumTypeResolver === null) {
            /** @var CommentTypeEnumTypeResolver */
            $commentTypeEnumTypeResolver = $this->instanceManager->getInstance(CommentTypeEnumTypeResolver::class);
            $this->commentTypeEnumTypeResolver = $commentTypeEnumTypeResolver;
        }
        return $this->commentTypeEnumTypeResolver;
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
        return ['customPost', 'customPostID', 'content', 'rawContent', 'authorName', 'authorURL', 'authorEmail', 'approved', 'type', 'status', 'parent', 'date', 'dateStr', 'responses', 'responseCount'];
    }
    /**
     * @return string[]
     */
    public function getSensitiveFieldNames() : array
    {
        $sensitiveFieldArgNames = parent::getSensitiveFieldNames();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->treatCommentRawContentAsSensitiveData()) {
            $sensitiveFieldArgNames[] = 'rawContent';
        }
        return $sensitiveFieldArgNames;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'authorName':
            case 'dateStr':
                return $this->getStringScalarTypeResolver();
            case 'type':
                return $this->getCommentTypeEnumTypeResolver();
            case 'content':
            case 'rawContent':
                return $this->getHTMLScalarTypeResolver();
            case 'authorURL':
                return $this->getURLScalarTypeResolver();
            case 'authorEmail':
                return $this->getEmailScalarTypeResolver();
            case 'customPostID':
                return $this->getIDScalarTypeResolver();
            case 'approved':
                return $this->getBooleanScalarTypeResolver();
            case 'date':
                return $this->getDateTimeScalarTypeResolver();
            case 'responseCount':
                return $this->getIntScalarTypeResolver();
            case 'customPost':
                return CustomPostUnionTypeHelpers::getCustomPostUnionOrTargetObjectTypeResolver();
            case 'parent':
            case 'responses':
                return $this->getCommentObjectTypeResolver();
            case 'status':
                return $this->getCommentStatusEnumTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'content':
            case 'rawContent':
            case 'customPost':
            case 'customPostID':
            case 'approved':
            case 'type':
            case 'status':
            case 'date':
            case 'dateStr':
            case 'responseCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'responses':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'content':
                return $this->__('Comment\'s content', 'pop-comments');
            case 'rawContent':
                return $this->__('Comment\'s content in raw format (as it exists in the database)', 'pop-comments');
            case 'authorName':
                return $this->__('Comment author\'s name', 'pop-comments');
            case 'authorURL':
                return $this->__('Comment author\'s URL', 'pop-comments');
            case 'authorEmail':
                return $this->__('Comment author\'s email', 'pop-comments');
            case 'customPost':
                return $this->__('Custom post to which the comment was added', 'pop-comments');
            case 'customPostID':
                return $this->__('ID of the custom post to which the comment was added', 'pop-comments');
            case 'approved':
                return $this->__('Is the comment approved?', 'pop-comments');
            case 'type':
                return $this->__('Type of comment', 'pop-comments');
            case 'status':
                return $this->__('Status of the comment', 'pop-comments');
            case 'parent':
                return $this->__('Parent comment (if this comment is a response to another one)', 'pop-comments');
            case 'date':
                return $this->__('Date when the comment was added', 'pop-comments');
            case 'dateStr':
                return $this->__('Date when the comment was added, in String format', 'pop-comments');
            case 'responses':
                return $this->__('Responses to the comment', 'pop-comments');
            case 'responseCount':
                return $this->__('Number of responses to the comment', 'pop-comments');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component
    {
        switch ($fieldName) {
            case 'date':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE);
            case 'dateStr':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE_AS_STRING);
            default:
                return parent::getFieldFilterInputContainerComponent($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'responses':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCommentResponsesFilterInputObjectTypeResolver(), 'pagination' => $this->getCommentResponsePaginationInputObjectTypeResolver(), 'sort' => $this->getCommentSortInputObjectTypeResolver()]);
            case 'responseCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCommentResponsesFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $comment = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'content':
                return $this->getCommentTypeAPI()->getCommentContent($comment);
            case 'rawContent':
                return $this->getCommentTypeAPI()->getCommentRawContent($comment);
            case 'authorName':
                return $this->getCommentTypeAPI()->getCommentAuthorName($comment);
            case 'authorURL':
                return $this->getCommentTypeAPI()->getCommentAuthorURL($comment);
            case 'authorEmail':
                return $this->getCommentTypeAPI()->getCommentAuthorEmail($comment);
            case 'customPost':
            case 'customPostID':
                return $this->getCommentTypeAPI()->getCommentPostID($comment);
            case 'approved':
                return $this->getCommentTypeAPI()->isCommentApproved($comment);
            case 'type':
                return $this->getCommentTypeAPI()->getCommentType($comment);
            case 'status':
                return $this->getCommentTypeAPI()->getCommentStatus($comment);
            case 'parent':
                return $this->getCommentTypeAPI()->getCommentParent($comment);
            case 'date':
                /** @var string */
                $date = $this->getCommentTypeAPI()->getCommentDate($comment, $fieldDataAccessor->getValue('gmt'));
                return new DateTime($date);
            case 'dateStr':
                /** @var string */
                $date = $this->getCommentTypeAPI()->getCommentDate($comment, $fieldDataAccessor->getValue('gmt'));
                return $this->getDateFormatter()->format($fieldDataAccessor->getValue('format'), $date);
        }
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), ['parent-id' => $objectTypeResolver->getID($comment)]);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'responses':
                return $this->getCommentTypeAPI()->getComments($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'responseCount':
                return $this->getCommentTypeAPI()->getCommentCount($query);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
