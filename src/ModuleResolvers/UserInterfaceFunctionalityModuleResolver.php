<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers;

use GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface;
use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\Registries\CustomPostTypeRegistryInterface;
use GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\CustomPostTypeInterface;

class UserInterfaceFunctionalityModuleResolver extends AbstractFunctionalityModuleResolver
{
    use ModuleResolverTrait;
    use UserInterfaceFunctionalityModuleResolverTrait;

    public const EXCERPT_AS_DESCRIPTION = Plugin::NAMESPACE . '\excerpt-as-description';
    public const WELCOME_GUIDES = Plugin::NAMESPACE . '\welcome-guides';
    public const SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION = Plugin::NAMESPACE . '\schema-configuration-additional-documentation';

    /** @var CustomPostTypeInterface[] */
    protected $useExcerptAsDescriptionEnabledCustomPostTypeServices;

    /**
     * @var \GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface|null
     */
    private $markdownContentParser;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\CustomPostTypeRegistryInterface|null
     */
    private $customPostTypeRegistry;

    final protected function getMarkdownContentParser(): MarkdownContentParserInterface
    {
        if ($this->markdownContentParser === null) {
            /** @var MarkdownContentParserInterface */
            $markdownContentParser = $this->instanceManager->getInstance(MarkdownContentParserInterface::class);
            $this->markdownContentParser = $markdownContentParser;
        }
        return $this->markdownContentParser;
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
            self::EXCERPT_AS_DESCRIPTION,
            self::WELCOME_GUIDES,
            self::SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION,
        ];
    }

    /**
     * @return array<string[]> List of entries that must be satisfied, each entry is an array where at least 1 module must be satisfied
     */
    public function getDependedModuleLists(string $module): array
    {
        switch ($module) {
            case self::EXCERPT_AS_DESCRIPTION:
            case self::WELCOME_GUIDES:
                return [];
            case self::SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION:
                return [
                    [
                        SchemaConfigurationFunctionalityModuleResolver::SCHEMA_CONFIGURATION,
                    ],
                ];
        }
        return parent::getDependedModuleLists($module);
    }

    public function areRequirementsSatisfied(string $module): bool
    {
        switch ($module) {
            case self::WELCOME_GUIDES:
                /**
                 * WordPress 5.5 or above, or Gutenberg 8.2 or above
                 */
                return
                    \is_wp_version_compatible('5.5') ||
                    (
                        defined('GUTENBERG_VERSION') &&
                        \version_compare(constant('GUTENBERG_VERSION'), '8.2', '>=')
                    );
        }
        return parent::areRequirementsSatisfied($module);
    }

    public function isHidden(string $module): bool
    {
        switch ($module) {
            case self::EXCERPT_AS_DESCRIPTION:
                return $this->getUseExcerptAsDescriptionEnabledCustomPostTypeServices() === [];
            case self::WELCOME_GUIDES:
            case self::SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION:
                return true;
        }
        return parent::isHidden($module);
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::EXCERPT_AS_DESCRIPTION:
                return \__('Excerpt as Description', 'gatographql');
            case self::WELCOME_GUIDES:
                return \__('Welcome Guides', 'gatographql');
            case self::SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION:
                return \__('Additional Gato GraphQL Documentation', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::EXCERPT_AS_DESCRIPTION:
                return \__('Provide a description of the different entities (Custom Endpoints, Persisted Queries, and others) through their excerpt', 'gatographql');
            case self::WELCOME_GUIDES:
                return sprintf(
                    \__('Display welcome guides which demonstrate how to use the plugin\'s different functionalities. <em>It requires WordPress version \'%s\' or above, or Gutenberg version \'%s\' or above</em>', 'gatographql'),
                    '5.5',
                    '8.2'
                );
            case self::SCHEMA_CONFIGURATION_ADDITIONAL_DOCUMENTATION:
                return \__('Documentation on using the Gato GraphQL', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    public function isPredefinedEnabledOrDisabled(string $module): ?bool
    {
        switch ($module) {
            case self::WELCOME_GUIDES:
                return false;
            case self::EXCERPT_AS_DESCRIPTION:
                return $this->getUseExcerptAsDescriptionEnabledCustomPostTypeServices() === [] ? false : null;
            default:
                return parent::isPredefinedEnabledOrDisabled($module);
        }
    }

    /**
     * @return CustomPostTypeInterface[]
     */
    protected function getUseExcerptAsDescriptionEnabledCustomPostTypeServices(): array
    {
        if ($this->useExcerptAsDescriptionEnabledCustomPostTypeServices === null) {
            $customPostTypeServices = $this->getCustomPostTypeRegistry()->getCustomPostTypes();
            $this->useExcerptAsDescriptionEnabledCustomPostTypeServices = array_values(array_filter(
                $customPostTypeServices,
                function (CustomPostTypeInterface $customPostTypeService) {
                    return $customPostTypeService->isServiceEnabled() && $customPostTypeService->useCustomPostExcerptAsDescription();
                }
            ));
        }
        return $this->useExcerptAsDescriptionEnabledCustomPostTypeServices;
    }
}
