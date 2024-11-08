<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMediaMutations\Module;
use PoPCMSSchema\CustomPostMediaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
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
class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver|null
     */
    private $customPostUnionTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $setFeaturedImageOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostBulkOperationMutationResolver|null
     */
    private $setFeaturedImageOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $removeFeaturedImageFromCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver|null
     */
    private $removeFeaturedImageFromCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootSetFeaturedImageOnCustomPostInputObjectTypeResolver|null
     */
    private $rootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver|null
     */
    private $rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $payloadableSetFeaturedImageOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
    protected final function getCustomPostUnionTypeResolver() : CustomPostUnionTypeResolver
    {
        if ($this->customPostUnionTypeResolver === null) {
            /** @var CustomPostUnionTypeResolver */
            $customPostUnionTypeResolver = $this->instanceManager->getInstance(CustomPostUnionTypeResolver::class);
            $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
        }
        return $this->customPostUnionTypeResolver;
    }
    protected final function getSetFeaturedImageOnCustomPostMutationResolver() : SetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->setFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var SetFeaturedImageOnCustomPostMutationResolver */
            $setFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(SetFeaturedImageOnCustomPostMutationResolver::class);
            $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->setFeaturedImageOnCustomPostMutationResolver;
    }
    protected final function getSetFeaturedImageOnCustomPostBulkOperationMutationResolver() : SetFeaturedImageOnCustomPostBulkOperationMutationResolver
    {
        if ($this->setFeaturedImageOnCustomPostBulkOperationMutationResolver === null) {
            /** @var SetFeaturedImageOnCustomPostBulkOperationMutationResolver */
            $setFeaturedImageOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(SetFeaturedImageOnCustomPostBulkOperationMutationResolver::class);
            $this->setFeaturedImageOnCustomPostBulkOperationMutationResolver = $setFeaturedImageOnCustomPostBulkOperationMutationResolver;
        }
        return $this->setFeaturedImageOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getRemoveFeaturedImageFromCustomPostMutationResolver() : RemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->removeFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var RemoveFeaturedImageFromCustomPostMutationResolver */
            $removeFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(RemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->removeFeaturedImageFromCustomPostMutationResolver = $removeFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->removeFeaturedImageFromCustomPostMutationResolver;
    }
    protected final function getRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver() : RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver
    {
        if ($this->removeFeaturedImageFromCustomPostBulkOperationMutationResolver === null) {
            /** @var RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver */
            $removeFeaturedImageFromCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver::class);
            $this->removeFeaturedImageFromCustomPostBulkOperationMutationResolver = $removeFeaturedImageFromCustomPostBulkOperationMutationResolver;
        }
        return $this->removeFeaturedImageFromCustomPostBulkOperationMutationResolver;
    }
    protected final function getRootSetFeaturedImageOnCustomPostInputObjectTypeResolver() : RootSetFeaturedImageOnCustomPostInputObjectTypeResolver
    {
        if ($this->rootSetFeaturedImageOnCustomPostInputObjectTypeResolver === null) {
            /** @var RootSetFeaturedImageOnCustomPostInputObjectTypeResolver */
            $rootSetFeaturedImageOnCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetFeaturedImageOnCustomPostInputObjectTypeResolver::class);
            $this->rootSetFeaturedImageOnCustomPostInputObjectTypeResolver = $rootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
        }
        return $this->rootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
    }
    protected final function getRootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver() : RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver
    {
        if ($this->rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver === null) {
            /** @var RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver */
            $rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver::class);
            $this->rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver = $rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
        }
        return $this->rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
    }
    protected final function getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : PayloadableSetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->payloadableSetFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetFeaturedImageOnCustomPostMutationResolver */
            $payloadableSetFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetFeaturedImageOnCustomPostMutationResolver::class);
            $this->payloadableSetFeaturedImageOnCustomPostMutationResolver = $payloadableSetFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->payloadableSetFeaturedImageOnCustomPostMutationResolver;
    }
    protected final function getPayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver() : PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver */
            $payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver::class);
            $this->payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver = $payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver;
    }
    protected final function getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : PayloadableRemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var PayloadableRemoveFeaturedImageFromCustomPostMutationResolver */
            $payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableRemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    }
    protected final function getPayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver() : PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver */
            $payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver::class);
            $this->payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver;
    }
    protected final function getRootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver() : RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver */
            $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver = $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver() : RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver */
            $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver = $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
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
        $addFieldsToQueryPayloadableCustomPostMediaMutations = $moduleConfiguration->addFieldsToQueryPayloadableCustomPostMediaMutations();
        return \array_merge(['setFeaturedImageOnCustomPost', 'setFeaturedImageOnCustomPosts', 'removeFeaturedImageFromCustomPost', 'removeFeaturedImageFromCustomPosts'], $addFieldsToQueryPayloadableCustomPostMediaMutations ? ['setFeaturedImageOnCustomPostMutationPayloadObjects', 'removeFeaturedImageFromCustomPostMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
                return $this->__('Set the featured image on a custom post', 'custompostmedia-mutations');
            case 'setFeaturedImageOnCustomPosts':
                return $this->__('Set the featured image on custom posts', 'custompostmedia-mutations');
            case 'removeFeaturedImageFromCustomPost':
                return $this->__('Remove the featured image from a custom post', 'custompostmedia-mutations');
            case 'removeFeaturedImageFromCustomPosts':
                return $this->__('Remove the featured image from custom posts', 'custompostmedia-mutations');
            case 'setFeaturedImageOnCustomPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setFeaturedImageOnCustomPost` mutation', 'custompostmedia-mutations');
            case 'removeFeaturedImageFromCustomPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `removeFeaturedImageFromCustomPost` mutation', 'custompostmedia-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        if (!$usePayloadableCustomPostMediaMutations) {
            switch ($fieldName) {
                case 'setFeaturedImageOnCustomPost':
                case 'removeFeaturedImageFromCustomPost':
                    return SchemaTypeModifiers::NONE;
                case 'setFeaturedImageOnCustomPosts':
                case 'removeFeaturedImageFromCustomPosts':
                    return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['setFeaturedImageOnCustomPostMutationPayloadObjects', 'removeFeaturedImageFromCustomPostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
            case 'removeFeaturedImageFromCustomPost':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'setFeaturedImageOnCustomPosts':
            case 'removeFeaturedImageFromCustomPosts':
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
            case 'setFeaturedImageOnCustomPost':
                return ['input' => $this->getRootSetFeaturedImageOnCustomPostInputObjectTypeResolver()];
            case 'setFeaturedImageOnCustomPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetFeaturedImageOnCustomPostInputObjectTypeResolver());
            case 'removeFeaturedImageFromCustomPost':
                return ['input' => $this->getRootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver()];
            case 'removeFeaturedImageFromCustomPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver());
            case 'setFeaturedImageOnCustomPostMutationPayloadObjects':
            case 'removeFeaturedImageFromCustomPostMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['setFeaturedImageOnCustomPostMutationPayloadObjects', 'removeFeaturedImageFromCustomPostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['setFeaturedImageOnCustomPosts', 'removeFeaturedImageFromCustomPosts'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['setFeaturedImageOnCustomPost' => 'input']:
            case ['removeFeaturedImageFromCustomPost' => 'input']:
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
        if (\in_array($fieldName, ['setFeaturedImageOnCustomPosts', 'removeFeaturedImageFromCustomPosts'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : $this->getSetFeaturedImageOnCustomPostMutationResolver();
            case 'setFeaturedImageOnCustomPosts':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver() : $this->getSetFeaturedImageOnCustomPostBulkOperationMutationResolver();
            case 'removeFeaturedImageFromCustomPost':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : $this->getRemoveFeaturedImageFromCustomPostMutationResolver();
            case 'removeFeaturedImageFromCustomPosts':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver() : $this->getRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        if ($usePayloadableCustomPostMediaMutations) {
            switch ($fieldName) {
                case 'setFeaturedImageOnCustomPost':
                case 'setFeaturedImageOnCustomPosts':
                case 'setFeaturedImageOnCustomPostMutationPayloadObjects':
                    return $this->getRootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver();
                case 'removeFeaturedImageFromCustomPost':
                case 'removeFeaturedImageFromCustomPosts':
                case 'removeFeaturedImageFromCustomPostMutationPayloadObjects':
                    return $this->getRootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
            case 'setFeaturedImageOnCustomPosts':
            case 'removeFeaturedImageFromCustomPost':
            case 'removeFeaturedImageFromCustomPosts':
                return $this->getCustomPostUnionTypeResolver();
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
            case 'setFeaturedImageOnCustomPostMutationPayloadObjects':
            case 'removeFeaturedImageFromCustomPostMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
