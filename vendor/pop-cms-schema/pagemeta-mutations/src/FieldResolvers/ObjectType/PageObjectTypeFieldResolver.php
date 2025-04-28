<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType\AbstractCustomPostObjectTypeFieldResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module as CustomPostMetaMutationsModule;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration as CustomPostMetaMutationsModuleConfiguration;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PageObjectTypeFieldResolver extends AbstractCustomPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $pageDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $pageCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $pageUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\ObjectType\PageSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $pageSetMetaMutationPayloadObjectTypeResolver;
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    protected final function getPageDeleteMetaMutationPayloadObjectTypeResolver() : PageDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->pageDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PageDeleteMetaMutationPayloadObjectTypeResolver */
            $pageDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PageDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->pageDeleteMetaMutationPayloadObjectTypeResolver = $pageDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->pageDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPageAddMetaMutationPayloadObjectTypeResolver() : PageAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->pageCreateMutationPayloadObjectTypeResolver === null) {
            /** @var PageAddMetaMutationPayloadObjectTypeResolver */
            $pageCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PageAddMetaMutationPayloadObjectTypeResolver::class);
            $this->pageCreateMutationPayloadObjectTypeResolver = $pageCreateMutationPayloadObjectTypeResolver;
        }
        return $this->pageCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getPageUpdateMetaMutationPayloadObjectTypeResolver() : PageUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->pageUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PageUpdateMetaMutationPayloadObjectTypeResolver */
            $pageUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PageUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->pageUpdateMetaMutationPayloadObjectTypeResolver = $pageUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->pageUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getPageSetMetaMutationPayloadObjectTypeResolver() : PageSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->pageSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var PageSetMetaMutationPayloadObjectTypeResolver */
            $pageSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(PageSetMetaMutationPayloadObjectTypeResolver::class);
            $this->pageSetMetaMutationPayloadObjectTypeResolver = $pageSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->pageSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PageObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMetaMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if (!$usePayloadableCustomPostMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getPageObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getPageAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getPageDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getPageSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getPageUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
