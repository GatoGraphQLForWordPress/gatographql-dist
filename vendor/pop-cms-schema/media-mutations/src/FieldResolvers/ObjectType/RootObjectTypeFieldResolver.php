<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MediaMutations\Module;
use PoPCMSSchema\MediaMutations\ModuleConfiguration;
use PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootCreateMediaItemMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
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
/** @internal */
class RootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver|null
     */
    private $mediaObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver|null
     */
    private $createMediaItemMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver|null
     */
    private $rootCreateMediaItemInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootCreateMediaItemMutationPayloadObjectTypeResolver|null
     */
    private $rootCreateMediaItemMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver|null
     */
    private $payloadableCreateMediaItemMutationResolver;
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
    public final function setCreateMediaItemMutationResolver(CreateMediaItemMutationResolver $createMediaItemMutationResolver) : void
    {
        $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
    }
    protected final function getCreateMediaItemMutationResolver() : CreateMediaItemMutationResolver
    {
        if ($this->createMediaItemMutationResolver === null) {
            /** @var CreateMediaItemMutationResolver */
            $createMediaItemMutationResolver = $this->instanceManager->getInstance(CreateMediaItemMutationResolver::class);
            $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
        }
        return $this->createMediaItemMutationResolver;
    }
    public final function setRootCreateMediaItemInputObjectTypeResolver(RootCreateMediaItemInputObjectTypeResolver $rootCreateMediaItemInputObjectTypeResolver) : void
    {
        $this->rootCreateMediaItemInputObjectTypeResolver = $rootCreateMediaItemInputObjectTypeResolver;
    }
    protected final function getRootCreateMediaItemInputObjectTypeResolver() : RootCreateMediaItemInputObjectTypeResolver
    {
        if ($this->rootCreateMediaItemInputObjectTypeResolver === null) {
            /** @var RootCreateMediaItemInputObjectTypeResolver */
            $rootCreateMediaItemInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreateMediaItemInputObjectTypeResolver::class);
            $this->rootCreateMediaItemInputObjectTypeResolver = $rootCreateMediaItemInputObjectTypeResolver;
        }
        return $this->rootCreateMediaItemInputObjectTypeResolver;
    }
    public final function setRootCreateMediaItemMutationPayloadObjectTypeResolver(RootCreateMediaItemMutationPayloadObjectTypeResolver $rootCreateMediaItemMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreateMediaItemMutationPayloadObjectTypeResolver = $rootCreateMediaItemMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreateMediaItemMutationPayloadObjectTypeResolver() : RootCreateMediaItemMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreateMediaItemMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreateMediaItemMutationPayloadObjectTypeResolver */
            $rootCreateMediaItemMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreateMediaItemMutationPayloadObjectTypeResolver::class);
            $this->rootCreateMediaItemMutationPayloadObjectTypeResolver = $rootCreateMediaItemMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreateMediaItemMutationPayloadObjectTypeResolver;
    }
    public final function setPayloadableCreateMediaItemMutationResolver(PayloadableCreateMediaItemMutationResolver $payloadableCreateMediaItemMutationResolver) : void
    {
        $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
    }
    protected final function getPayloadableCreateMediaItemMutationResolver() : PayloadableCreateMediaItemMutationResolver
    {
        if ($this->payloadableCreateMediaItemMutationResolver === null) {
            /** @var PayloadableCreateMediaItemMutationResolver */
            $payloadableCreateMediaItemMutationResolver = $this->instanceManager->getInstance(PayloadableCreateMediaItemMutationResolver::class);
            $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
        }
        return $this->payloadableCreateMediaItemMutationResolver;
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
        return ['createMediaItem'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createMediaItem':
                return $this->__('Upload an attachment', 'media-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        if (!$usePayloadableMediaMutations) {
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'createMediaItem':
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
            case 'createMediaItem':
                return [MutationInputProperties::INPUT => $this->getRootCreateMediaItemInputObjectTypeResolver()];
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
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        switch ($fieldName) {
            case 'createMediaItem':
                return $usePayloadableMediaMutations ? $this->getPayloadableCreateMediaItemMutationResolver() : $this->getCreateMediaItemMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        if ($usePayloadableMediaMutations) {
            switch ($fieldName) {
                case 'createMediaItem':
                    return $this->getRootCreateMediaItemMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createMediaItem':
                return $this->getMediaObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
