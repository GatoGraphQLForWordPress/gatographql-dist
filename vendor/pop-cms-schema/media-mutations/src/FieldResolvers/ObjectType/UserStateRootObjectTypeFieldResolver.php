<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootMyMediaItemsFilterInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemSortInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemPaginationInputObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
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
use PoP\Root\App;
/** @internal */
class UserStateRootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
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
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootMyMediaItemsFilterInputObjectTypeResolver|null
     */
    private $rootMyMediaItemsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\RootMediaItemPaginationInputObjectTypeResolver|null
     */
    private $rootMediaItemPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemSortInputObjectTypeResolver|null
     */
    private $mediaItemSortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
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
    public final function setRootMyMediaItemsFilterInputObjectTypeResolver(RootMyMediaItemsFilterInputObjectTypeResolver $rootMyMediaItemsFilterInputObjectTypeResolver) : void
    {
        $this->rootMyMediaItemsFilterInputObjectTypeResolver = $rootMyMediaItemsFilterInputObjectTypeResolver;
    }
    protected final function getRootMyMediaItemsFilterInputObjectTypeResolver() : RootMyMediaItemsFilterInputObjectTypeResolver
    {
        if ($this->rootMyMediaItemsFilterInputObjectTypeResolver === null) {
            /** @var RootMyMediaItemsFilterInputObjectTypeResolver */
            $rootMyMediaItemsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootMyMediaItemsFilterInputObjectTypeResolver::class);
            $this->rootMyMediaItemsFilterInputObjectTypeResolver = $rootMyMediaItemsFilterInputObjectTypeResolver;
        }
        return $this->rootMyMediaItemsFilterInputObjectTypeResolver;
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
    public final function setUserLoggedInCheckpoint(UserLoggedInCheckpoint $userLoggedInCheckpoint) : void
    {
        $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
    }
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
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
        return ['myMediaItem', 'myMediaItemCount', 'myMediaItems'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'myMediaItemCount':
                return $this->getIntScalarTypeResolver();
            case 'myMediaItems':
            case 'myMediaItem':
                return $this->getMediaObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'myMediaItemCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'myMediaItems':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'myMediaItem':
                return $this->__('Media item by the logged-in user on the site with a specific ID', 'media-mutations');
            case 'myMediaItemCount':
                return $this->__('Number of media items by the logged-in user on the site', 'media-mutations');
            case 'myMediaItems':
                return $this->__('Media items by the logged-in user on the site', 'media-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'myMediaItem':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getMediaItemByOneofInputObjectTypeResolver()]);
            case 'myMediaItems':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyMediaItemsFilterInputObjectTypeResolver(), 'pagination' => $this->getRootMediaItemPaginationInputObjectTypeResolver(), 'sort' => $this->getMediaItemSortInputObjectTypeResolver()]);
            case 'myMediaItemCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyMediaItemsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['myMediaItem' => 'by']:
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
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), ['author-ids' => [App::getState('current-user-id')]]);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'myMediaItemCount':
                return $this->getMediaTypeAPI()->getMediaItemCount($query);
            case 'myMediaItems':
                return $this->getMediaTypeAPI()->getMediaItems($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'myMediaItem':
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
    /**
     * @return CheckpointInterface[]
     */
    public function getValidationCheckpoints(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, object $object) : array
    {
        $validationCheckpoints = parent::getValidationCheckpoints($objectTypeResolver, $fieldDataAccessor, $object);
        $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
        return $validationCheckpoints;
    }
}
