<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMediaMutations\Module;
use PoPCMSSchema\CustomPostMediaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\RootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver|null
     */
    private $customPostUnionTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $setFeaturedImageOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $removeFeaturedImageFromCustomPostMutationResolver;
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
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
    public final function setCustomPostUnionTypeResolver(CustomPostUnionTypeResolver $customPostUnionTypeResolver) : void
    {
        $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
    }
    protected final function getCustomPostUnionTypeResolver() : CustomPostUnionTypeResolver
    {
        if ($this->customPostUnionTypeResolver === null) {
            /** @var CustomPostUnionTypeResolver */
            $customPostUnionTypeResolver = $this->instanceManager->getInstance(CustomPostUnionTypeResolver::class);
            $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
        }
        return $this->customPostUnionTypeResolver;
    }
    public final function setSetFeaturedImageOnCustomPostMutationResolver(SetFeaturedImageOnCustomPostMutationResolver $setFeaturedImageOnCustomPostMutationResolver) : void
    {
        $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
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
    public final function setRemoveFeaturedImageFromCustomPostMutationResolver(RemoveFeaturedImageFromCustomPostMutationResolver $removeFeaturedImageFromCustomPostMutationResolver) : void
    {
        $this->removeFeaturedImageFromCustomPostMutationResolver = $removeFeaturedImageFromCustomPostMutationResolver;
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
    public final function setRootSetFeaturedImageOnCustomPostInputObjectTypeResolver(RootSetFeaturedImageOnCustomPostInputObjectTypeResolver $rootSetFeaturedImageOnCustomPostInputObjectTypeResolver) : void
    {
        $this->rootSetFeaturedImageOnCustomPostInputObjectTypeResolver = $rootSetFeaturedImageOnCustomPostInputObjectTypeResolver;
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
    public final function setRootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver(RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver $rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver) : void
    {
        $this->rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver = $rootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver;
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
    public final function setPayloadableSetFeaturedImageOnCustomPostMutationResolver(PayloadableSetFeaturedImageOnCustomPostMutationResolver $payloadableSetFeaturedImageOnCustomPostMutationResolver) : void
    {
        $this->payloadableSetFeaturedImageOnCustomPostMutationResolver = $payloadableSetFeaturedImageOnCustomPostMutationResolver;
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
    public final function setPayloadableRemoveFeaturedImageFromCustomPostMutationResolver(PayloadableRemoveFeaturedImageFromCustomPostMutationResolver $payloadableRemoveFeaturedImageFromCustomPostMutationResolver) : void
    {
        $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
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
    public final function setRootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver(RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver = $rootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
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
    public final function setRootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver(RootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver = $rootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver;
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
        $moduleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        if ($moduleConfiguration->disableRedundantRootTypeMutationFields()) {
            return [];
        }
        return ['setFeaturedImageOnCustomPost', 'removeFeaturedImageFromCustomPost'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
                return $this->__('Set the featured image on a custom post', 'custompostmedia-mutations');
            case 'removeFeaturedImageFromCustomPost':
                return $this->__('Remove the featured image from a custom post', 'custompostmedia-mutations');
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
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
            case 'removeFeaturedImageFromCustomPost':
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
            case 'setFeaturedImageOnCustomPost':
                return ['input' => $this->getRootSetFeaturedImageOnCustomPostInputObjectTypeResolver()];
            case 'removeFeaturedImageFromCustomPost':
                return ['input' => $this->getRootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver()];
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
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : $this->getSetFeaturedImageOnCustomPostMutationResolver();
            case 'removeFeaturedImageFromCustomPost':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : $this->getRemoveFeaturedImageFromCustomPostMutationResolver();
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
                    return $this->getRootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver();
                case 'removeFeaturedImageFromCustomPost':
                    return $this->getRootRemoveFeaturedImageFromCustomPostMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'setFeaturedImageOnCustomPost':
            case 'removeFeaturedImageFromCustomPost':
                return $this->getCustomPostUnionTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
