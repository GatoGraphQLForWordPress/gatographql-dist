<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\Module as CustomPostMutationsModule;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration as CustomPostMutationsModuleConfiguration;
use PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver;
use PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver;
use PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver;
use PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\RootCreatePageInputObjectTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\RootUpdatePageInputObjectTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\RootCreatePageMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\RootUpdatePageMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
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
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\RootUpdatePageMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePageMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\RootCreatePageMutationPayloadObjectTypeResolver|null
     */
    private $rootCreatePageMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver|null
     */
    private $createPageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver|null
     */
    private $updatePageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver|null
     */
    private $payloadableUpdatePageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver|null
     */
    private $payloadableCreatePageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\RootUpdatePageInputObjectTypeResolver|null
     */
    private $rootUpdatePageInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\RootCreatePageInputObjectTypeResolver|null
     */
    private $rootCreatePageInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    public final function setPageObjectTypeResolver(PageObjectTypeResolver $pageObjectTypeResolver) : void
    {
        $this->pageObjectTypeResolver = $pageObjectTypeResolver;
    }
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    public final function setRootUpdatePageMutationPayloadObjectTypeResolver(RootUpdatePageMutationPayloadObjectTypeResolver $rootUpdatePageMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdatePageMutationPayloadObjectTypeResolver = $rootUpdatePageMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePageMutationPayloadObjectTypeResolver() : RootUpdatePageMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePageMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePageMutationPayloadObjectTypeResolver */
            $rootUpdatePageMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePageMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePageMutationPayloadObjectTypeResolver = $rootUpdatePageMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePageMutationPayloadObjectTypeResolver;
    }
    public final function setRootCreatePageMutationPayloadObjectTypeResolver(RootCreatePageMutationPayloadObjectTypeResolver $rootCreatePageMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreatePageMutationPayloadObjectTypeResolver = $rootCreatePageMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreatePageMutationPayloadObjectTypeResolver() : RootCreatePageMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreatePageMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreatePageMutationPayloadObjectTypeResolver */
            $rootCreatePageMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePageMutationPayloadObjectTypeResolver::class);
            $this->rootCreatePageMutationPayloadObjectTypeResolver = $rootCreatePageMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreatePageMutationPayloadObjectTypeResolver;
    }
    public final function setCreatePageMutationResolver(CreatePageMutationResolver $createPageMutationResolver) : void
    {
        $this->createPageMutationResolver = $createPageMutationResolver;
    }
    protected final function getCreatePageMutationResolver() : CreatePageMutationResolver
    {
        if ($this->createPageMutationResolver === null) {
            /** @var CreatePageMutationResolver */
            $createPageMutationResolver = $this->instanceManager->getInstance(CreatePageMutationResolver::class);
            $this->createPageMutationResolver = $createPageMutationResolver;
        }
        return $this->createPageMutationResolver;
    }
    public final function setUpdatePageMutationResolver(UpdatePageMutationResolver $updatePageMutationResolver) : void
    {
        $this->updatePageMutationResolver = $updatePageMutationResolver;
    }
    protected final function getUpdatePageMutationResolver() : UpdatePageMutationResolver
    {
        if ($this->updatePageMutationResolver === null) {
            /** @var UpdatePageMutationResolver */
            $updatePageMutationResolver = $this->instanceManager->getInstance(UpdatePageMutationResolver::class);
            $this->updatePageMutationResolver = $updatePageMutationResolver;
        }
        return $this->updatePageMutationResolver;
    }
    public final function setPayloadableUpdatePageMutationResolver(PayloadableUpdatePageMutationResolver $payloadableUpdatePageMutationResolver) : void
    {
        $this->payloadableUpdatePageMutationResolver = $payloadableUpdatePageMutationResolver;
    }
    protected final function getPayloadableUpdatePageMutationResolver() : PayloadableUpdatePageMutationResolver
    {
        if ($this->payloadableUpdatePageMutationResolver === null) {
            /** @var PayloadableUpdatePageMutationResolver */
            $payloadableUpdatePageMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePageMutationResolver::class);
            $this->payloadableUpdatePageMutationResolver = $payloadableUpdatePageMutationResolver;
        }
        return $this->payloadableUpdatePageMutationResolver;
    }
    public final function setPayloadableCreatePageMutationResolver(PayloadableCreatePageMutationResolver $payloadableCreatePageMutationResolver) : void
    {
        $this->payloadableCreatePageMutationResolver = $payloadableCreatePageMutationResolver;
    }
    protected final function getPayloadableCreatePageMutationResolver() : PayloadableCreatePageMutationResolver
    {
        if ($this->payloadableCreatePageMutationResolver === null) {
            /** @var PayloadableCreatePageMutationResolver */
            $payloadableCreatePageMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePageMutationResolver::class);
            $this->payloadableCreatePageMutationResolver = $payloadableCreatePageMutationResolver;
        }
        return $this->payloadableCreatePageMutationResolver;
    }
    public final function setRootUpdatePageInputObjectTypeResolver(RootUpdatePageInputObjectTypeResolver $rootUpdatePageInputObjectTypeResolver) : void
    {
        $this->rootUpdatePageInputObjectTypeResolver = $rootUpdatePageInputObjectTypeResolver;
    }
    protected final function getRootUpdatePageInputObjectTypeResolver() : RootUpdatePageInputObjectTypeResolver
    {
        if ($this->rootUpdatePageInputObjectTypeResolver === null) {
            /** @var RootUpdatePageInputObjectTypeResolver */
            $rootUpdatePageInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePageInputObjectTypeResolver::class);
            $this->rootUpdatePageInputObjectTypeResolver = $rootUpdatePageInputObjectTypeResolver;
        }
        return $this->rootUpdatePageInputObjectTypeResolver;
    }
    public final function setRootCreatePageInputObjectTypeResolver(RootCreatePageInputObjectTypeResolver $rootCreatePageInputObjectTypeResolver) : void
    {
        $this->rootCreatePageInputObjectTypeResolver = $rootCreatePageInputObjectTypeResolver;
    }
    protected final function getRootCreatePageInputObjectTypeResolver() : RootCreatePageInputObjectTypeResolver
    {
        if ($this->rootCreatePageInputObjectTypeResolver === null) {
            /** @var RootCreatePageInputObjectTypeResolver */
            $rootCreatePageInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePageInputObjectTypeResolver::class);
            $this->rootCreatePageInputObjectTypeResolver = $rootCreatePageInputObjectTypeResolver;
        }
        return $this->rootCreatePageInputObjectTypeResolver;
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
        /** @var EngineModuleConfiguration */
        $moduleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        return \array_merge(['createPage'], !$moduleConfiguration->disableRedundantRootTypeMutationFields() ? ['updatePage'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createPage':
                return $this->__('Create a page', 'page-mutations');
            case 'updatePage':
                return $this->__('Update a page', 'page-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if (!$usePayloadableCustomPostMutations) {
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'createPage':
            case 'updatePage':
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
            case 'createPage':
                return ['input' => $this->getRootCreatePageInputObjectTypeResolver()];
            case 'updatePage':
                return ['input' => $this->getRootUpdatePageInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ($fieldArgName) {
            case 'input':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'createPage':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreatePageMutationResolver() : $this->getCreatePageMutationResolver();
            case 'updatePage':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdatePageMutationResolver() : $this->getUpdatePageMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createPage':
                    return $this->getRootCreatePageMutationPayloadObjectTypeResolver();
                case 'updatePage':
                    return $this->getRootUpdatePageMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createPage':
            case 'updatePage':
                return $this->getPageObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return CheckpointInterface[]
     */
    public function getValidationCheckpoints(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, object $object) : array
    {
        $validationCheckpoints = parent::getValidationCheckpoints($objectTypeResolver, $fieldDataAccessor, $object);
        /**
         * For Payloadable: The "User Logged-in" checkpoint validation is not added,
         * instead this validation is executed inside the mutation, so the error
         * shows up in the Payload
         *
         * @var CustomPostMutationsModuleConfiguration
         */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createPage':
            case 'updatePage':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
}
