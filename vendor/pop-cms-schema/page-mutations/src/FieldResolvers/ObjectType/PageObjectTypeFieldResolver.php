<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMutations\Module as CustomPostMutationsModule;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration as CustomPostMutationsModuleConfiguration;
use PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver;
use PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageUpdateInputObjectTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\PageUpdateMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PageObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\PageUpdateMutationPayloadObjectTypeResolver|null
     */
    private $pageUpdateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver|null
     */
    private $updatePageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver|null
     */
    private $payloadableUpdatePageMutationResolver;
    /**
     * @var \PoPCMSSchema\PageMutations\TypeResolvers\InputObjectType\PageUpdateInputObjectTypeResolver|null
     */
    private $pageUpdateInputObjectTypeResolver;
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    protected final function getPageUpdateMutationPayloadObjectTypeResolver() : PageUpdateMutationPayloadObjectTypeResolver
    {
        if ($this->pageUpdateMutationPayloadObjectTypeResolver === null) {
            /** @var PageUpdateMutationPayloadObjectTypeResolver */
            $pageUpdateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PageUpdateMutationPayloadObjectTypeResolver::class);
            $this->pageUpdateMutationPayloadObjectTypeResolver = $pageUpdateMutationPayloadObjectTypeResolver;
        }
        return $this->pageUpdateMutationPayloadObjectTypeResolver;
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
    protected final function getPayloadableUpdatePageMutationResolver() : PayloadableUpdatePageMutationResolver
    {
        if ($this->payloadableUpdatePageMutationResolver === null) {
            /** @var PayloadableUpdatePageMutationResolver */
            $payloadableUpdatePageMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePageMutationResolver::class);
            $this->payloadableUpdatePageMutationResolver = $payloadableUpdatePageMutationResolver;
        }
        return $this->payloadableUpdatePageMutationResolver;
    }
    protected final function getPageUpdateInputObjectTypeResolver() : PageUpdateInputObjectTypeResolver
    {
        if ($this->pageUpdateInputObjectTypeResolver === null) {
            /** @var PageUpdateInputObjectTypeResolver */
            $pageUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(PageUpdateInputObjectTypeResolver::class);
            $this->pageUpdateInputObjectTypeResolver = $pageUpdateInputObjectTypeResolver;
        }
        return $this->pageUpdateInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PageObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the page', 'page-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'update':
                return ['input' => $this->getPageUpdateInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'update':
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
        switch ($fieldName) {
            case 'update':
                return $usePayloadableCustomPostMutations ? $this->getPageUpdateMutationPayloadObjectTypeResolver() : $this->getPageObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
