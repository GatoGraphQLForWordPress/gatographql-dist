<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\FieldResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractQueryableSchemaInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CustomPostCommentPaginationInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CustomPostCommentsFilterInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InterfaceType\CommentableInterfaceTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
class CommentableInterfaceTypeFieldResolver extends AbstractQueryableSchemaInterfaceTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CustomPostCommentsFilterInputObjectTypeResolver|null
     */
    private $customPostCommentsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CustomPostCommentPaginationInputObjectTypeResolver|null
     */
    private $customPostCommentPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver|null
     */
    private $commentSortInputObjectTypeResolver;
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
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
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
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
    public final function setCustomPostCommentsFilterInputObjectTypeResolver(CustomPostCommentsFilterInputObjectTypeResolver $customPostCommentsFilterInputObjectTypeResolver) : void
    {
        $this->customPostCommentsFilterInputObjectTypeResolver = $customPostCommentsFilterInputObjectTypeResolver;
    }
    protected final function getCustomPostCommentsFilterInputObjectTypeResolver() : CustomPostCommentsFilterInputObjectTypeResolver
    {
        if ($this->customPostCommentsFilterInputObjectTypeResolver === null) {
            /** @var CustomPostCommentsFilterInputObjectTypeResolver */
            $customPostCommentsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostCommentsFilterInputObjectTypeResolver::class);
            $this->customPostCommentsFilterInputObjectTypeResolver = $customPostCommentsFilterInputObjectTypeResolver;
        }
        return $this->customPostCommentsFilterInputObjectTypeResolver;
    }
    public final function setCustomPostCommentPaginationInputObjectTypeResolver(CustomPostCommentPaginationInputObjectTypeResolver $customPostCommentPaginationInputObjectTypeResolver) : void
    {
        $this->customPostCommentPaginationInputObjectTypeResolver = $customPostCommentPaginationInputObjectTypeResolver;
    }
    protected final function getCustomPostCommentPaginationInputObjectTypeResolver() : CustomPostCommentPaginationInputObjectTypeResolver
    {
        if ($this->customPostCommentPaginationInputObjectTypeResolver === null) {
            /** @var CustomPostCommentPaginationInputObjectTypeResolver */
            $customPostCommentPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostCommentPaginationInputObjectTypeResolver::class);
            $this->customPostCommentPaginationInputObjectTypeResolver = $customPostCommentPaginationInputObjectTypeResolver;
        }
        return $this->customPostCommentPaginationInputObjectTypeResolver;
    }
    public final function setCommentSortInputObjectTypeResolver(CommentSortInputObjectTypeResolver $commentSortInputObjectTypeResolver) : void
    {
        $this->commentSortInputObjectTypeResolver = $commentSortInputObjectTypeResolver;
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
    /**
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo() : array
    {
        return [CommentableInterfaceTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['areCommentsOpen', 'hasComments', 'commentCount', 'comments'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'comments':
                return $this->getCommentObjectTypeResolver();
            case 'areCommentsOpen':
                return $this->getBooleanScalarTypeResolver();
            case 'hasComments':
                return $this->getBooleanScalarTypeResolver();
            case 'commentCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'areCommentsOpen':
            case 'hasComments':
            case 'commentCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'comments':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'areCommentsOpen':
                return $this->__('Are comments open to be added to the custom post', 'pop-comments');
            case 'hasComments':
                return $this->__('Does the custom post have comments?', 'pop-comments');
            case 'commentCount':
                return $this->__('Number of comments added to the custom post', 'pop-comments');
            case 'comments':
                return $this->__('Comments added to the custom post', 'pop-comments');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($fieldName);
        switch ($fieldName) {
            case 'comments':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCustomPostCommentsFilterInputObjectTypeResolver(), 'pagination' => $this->getCustomPostCommentPaginationInputObjectTypeResolver(), 'sort' => $this->getCommentSortInputObjectTypeResolver()]);
            case 'commentCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCustomPostCommentsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
}
