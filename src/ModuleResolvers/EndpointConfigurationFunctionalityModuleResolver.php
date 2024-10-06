<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers;

use GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface;
use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\Registries\CustomPostTypeRegistryInterface;
use GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\CustomPostTypeInterface;
use GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\GraphQLEndpointCustomPostTypeInterface;

class EndpointConfigurationFunctionalityModuleResolver extends AbstractFunctionalityModuleResolver
{
    use ModuleResolverTrait;
    use EndpointConfigurationFunctionalityModuleResolverTrait;

    public const API_HIERARCHY = Plugin::NAMESPACE . '\api-hierarchy';

    /** @var GraphQLEndpointCustomPostTypeInterface[] */
    protected $hierarchicalEndpointCustomPostTypeServices;

    /**
     * @var \GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface|null
     */
    private $markdownContentParser;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\CustomPostTypeRegistryInterface|null
     */
    private $customPostTypeRegistry;

    final public function setMarkdownContentParser(MarkdownContentParserInterface $markdownContentParser): void
    {
        $this->markdownContentParser = $markdownContentParser;
    }
    final protected function getMarkdownContentParser(): MarkdownContentParserInterface
    {
        if ($this->markdownContentParser === null) {
            /** @var MarkdownContentParserInterface */
            $markdownContentParser = $this->instanceManager->getInstance(MarkdownContentParserInterface::class);
            $this->markdownContentParser = $markdownContentParser;
        }
        return $this->markdownContentParser;
    }
    final public function setCustomPostTypeRegistry(CustomPostTypeRegistryInterface $customPostTypeRegistry): void
    {
        $this->customPostTypeRegistry = $customPostTypeRegistry;
    }
    final protected function getCustomPostTypeRegistry(): CustomPostTypeRegistryInterface
    {
        if ($this->customPostTypeRegistry === null) {
            /** @var CustomPostTypeRegistryInterface */
            $customPostTypeRegistry = $this->instanceManager->getInstance(CustomPostTypeRegistryInterface::class);
            $this->customPostTypeRegistry = $customPostTypeRegistry;
        }
        return $this->customPostTypeRegistry;
    }

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return [
            self::API_HIERARCHY,
        ];
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::API_HIERARCHY:
                return \__('API Hierarchy', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::API_HIERARCHY:
                return \__('Create a hierarchy of API endpoints extending from other endpoints, and inheriting their properties', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    /**
     * If there are no endpoint CPTs enabled, the API Hierarchy
     * module is disabled
     */
    public function isPredefinedEnabledOrDisabled(string $module): ?bool
    {
        if (
            $module === self::API_HIERARCHY
            && $this->getHierarchicalEndpointCustomPostTypeServices() === []
        ) {
            return false;
        }
        return parent::isPredefinedEnabledOrDisabled($module);
    }

    public function isHidden(string $module): bool
    {
        if (
            $module === self::API_HIERARCHY
            && $this->getHierarchicalEndpointCustomPostTypeServices() === []
        ) {
            return true;
        }
        return parent::isHidden($module);
    }

    /**
     * @return GraphQLEndpointCustomPostTypeInterface[]
     */
    protected function getHierarchicalEndpointCustomPostTypeServices(): array
    {
        if ($this->hierarchicalEndpointCustomPostTypeServices === null) {
            $customPostTypeServices = $this->getCustomPostTypeRegistry()->getCustomPostTypes();
            $endpointCustomPostTypeServices = array_values(array_filter(
                $customPostTypeServices,
                function (CustomPostTypeInterface $customPostTypeService) {
                    return $customPostTypeService instanceof GraphQLEndpointCustomPostTypeInterface;
                }
            ));
            $this->hierarchicalEndpointCustomPostTypeServices = array_values(array_filter(
                $endpointCustomPostTypeServices,
                function (GraphQLEndpointCustomPostTypeInterface $graphQLEndpointCustomPostTypeService) {
                    return $graphQLEndpointCustomPostTypeService->isHierarchical();
                }
            ));
        }
        return $this->hierarchicalEndpointCustomPostTypeServices;
    }
}
