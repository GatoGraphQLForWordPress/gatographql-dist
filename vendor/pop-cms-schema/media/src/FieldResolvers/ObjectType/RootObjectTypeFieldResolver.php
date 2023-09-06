<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\FieldResolvers\ObjectType;

use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemSortInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemPaginationInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemsFilterInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface|null
     */
    private $mediaTypeAPI;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver|null
     */
    private $mediaObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver|null
     */
    private $mediaItemByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemsFilterInputObjectTypeResolver|null
     */
    private $rootMediaItemsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemPaginationInputObjectTypeResolver|null
     */
    private $rootMediaItemPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemSortInputObjectTypeResolver|null
     */
    private $mediaItemSortInputObjectTypeResolver;
    public final function setMediaTypeAPI(MediaTypeAPIInterface $mediaTypeAPI) : void
    {
        $this->mediaTypeAPI = $mediaTypeAPI;
    }
    protected final function getMediaTypeAPI() : MediaTypeAPIInterface
    {
        if ($this->mediaTypeAPI === null) {
            /** @var MediaTypeAPIInterface */
            $mediaTypeAPI = $this->instanceManager->getInstance(MediaTypeAPIInterface::class);
            $this->mediaTypeAPI = $mediaTypeAPI;
        }
        return $this->mediaTypeAPI;
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
    public final function setMediaObjectTypeResolver(MediaObjectTypeResolver $mediaObjectTypeResolver) : void
    {
        $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
    }
    protected final function getMediaObjectTypeResolver() : MediaObjectTypeResolver
    {
        if ($this->mediaObjectTypeResolver === null) {
            /** @var MediaObjectTypeResolver */
            $mediaObjectTypeResolver = $this->instanceManager->getInstance(MediaObjectTypeResolver::class);
            $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
        }
        return $this->mediaObjectTypeResolver;
    }
    public final function setMediaItemByOneofInputObjectTypeResolver(MediaItemByOneofInputObjectTypeResolver $mediaItemByOneofInputObjectTypeResolver) : void
    {
        $this->mediaItemByOneofInputObjectTypeResolver = $mediaItemByOneofInputObjectTypeResolver;
    }
    protected final function getMediaItemByOneofInputObjectTypeResolver() : MediaItemByOneofInputObjectTypeResolver
    {
        if ($this->mediaItemByOneofInputObjectTypeResolver === null) {
            /** @var MediaItemByOneofInputObjectTypeResolver */
            $mediaItemByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(MediaItemByOneofInputObjectTypeResolver::class);
            $this->mediaItemByOneofInputObjectTypeResolver = $mediaItemByOneofInputObjectTypeResolver;
        }
        return $this->mediaItemByOneofInputObjectTypeResolver;
    }
    public final function setRootMediaItemsFilterInputObjectTypeResolver(RootMediaItemsFilterInputObjectTypeResolver $rootMediaItemsFilterInputObjectTypeResolver) : void
    {
        $this->rootMediaItemsFilterInputObjectTypeResolver = $rootMediaItemsFilterInputObjectTypeResolver;
    }
    protected final function getRootMediaItemsFilterInputObjectTypeResolver() : RootMediaItemsFilterInputObjectTypeResolver
    {
        if ($this->rootMediaItemsFilterInputObjectTypeResolver === null) {
            /** @var RootMediaItemsFilterInputObjectTypeResolver */
            $rootMediaItemsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootMediaItemsFilterInputObjectTypeResolver::class);
            $this->rootMediaItemsFilterInputObjectTypeResolver = $rootMediaItemsFilterInputObjectTypeResolver;
        }
        return $this->rootMediaItemsFilterInputObjectTypeResolver;
    }
    public final function setRootMediaItemPaginationInputObjectTypeResolver(RootMediaItemPaginationInputObjectTypeResolver $rootMediaItemPaginationInputObjectTypeResolver) : void
    {
        $this->rootMediaItemPaginationInputObjectTypeResolver = $rootMediaItemPaginationInputObjectTypeResolver;
    }
    protected final function getRootMediaItemPaginationInputObjectTypeResolver() : RootMediaItemPaginationInputObjectTypeResolver
    {
        if ($this->rootMediaItemPaginationInputObjectTypeResolver === null) {
            /** @var RootMediaItemPaginationInputObjectTypeResolver */
            $rootMediaItemPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(RootMediaItemPaginationInputObjectTypeResolver::class);
            $this->rootMediaItemPaginationInputObjectTypeResolver = $rootMediaItemPaginationInputObjectTypeResolver;
        }
        return $this->rootMediaItemPaginationInputObjectTypeResolver;
    }
    public final function setMediaItemSortInputObjectTypeResolver(MediaItemSortInputObjectTypeResolver $mediaItemSortInputObjectTypeResolver) : void
    {
        $this->mediaItemSortInputObjectTypeResolver = $mediaItemSortInputObjectTypeResolver;
    }
    protected final function getMediaItemSortInputObjectTypeResolver() : MediaItemSortInputObjectTypeResolver
    {
        if ($this->mediaItemSortInputObjectTypeResolver === null) {
            /** @var MediaItemSortInputObjectTypeResolver */
            $mediaItemSortInputObjectTypeResolver = $this->instanceManager->getInstance(MediaItemSortInputObjectTypeResolver::class);
            $this->mediaItemSortInputObjectTypeResolver = $mediaItemSortInputObjectTypeResolver;
        }
        return $this->mediaItemSortInputObjectTypeResolver;
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
        return ['mediaItem', 'mediaItems', 'mediaItemCount'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'mediaItem':
                return $this->__('Get a media item', 'media');
            case 'mediaItems':
                return $this->__('Get the media items', 'media');
            case 'mediaItemCount':
                return $this->__('Number of media items', 'media');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'mediaItems':
            case 'mediaItem':
                return $this->getMediaObjectTypeResolver();
            case 'mediaItemCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'mediaItems':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            case 'mediaItemCount':
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
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'mediaItem':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getMediaItemByOneofInputObjectTypeResolver()]);
            case 'mediaItems':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMediaItemsFilterInputObjectTypeResolver(), 'pagination' => $this->getRootMediaItemPaginationInputObjectTypeResolver(), 'sort' => $this->getMediaItemSortInputObjectTypeResolver()]);
            case 'mediaItemCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMediaItemsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['mediaItem' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'mediaItemCount':
                return $this->getMediaTypeAPI()->getMediaItemCount($query);
            case 'mediaItems':
                return $this->getMediaTypeAPI()->getMediaItems($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'mediaItem':
                if ($mediaItems = $this->getMediaTypeAPI()->getMediaItems($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $mediaItems[0];
                }
                return null;
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
