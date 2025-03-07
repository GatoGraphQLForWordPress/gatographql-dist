<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\BlockCategories;

use GatoGraphQL\GatoGraphQL\ModuleResolvers\SchemaConfigurationFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface;
use GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\GraphQLSchemaConfigurationCustomPostType;

class SchemaConfigurationBlockCategory extends AbstractBlockCategory
{
    public const SCHEMA_CONFIGURATION_BLOCK_CATEGORY = 'gatographql-schema-config';

    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\GraphQLSchemaConfigurationCustomPostType|null
     */
    private $graphQLSchemaConfigurationCustomPostType;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface|null
     */
    private $moduleRegistry;

    final protected function getGraphQLSchemaConfigurationCustomPostType(): GraphQLSchemaConfigurationCustomPostType
    {
        if ($this->graphQLSchemaConfigurationCustomPostType === null) {
            /** @var GraphQLSchemaConfigurationCustomPostType */
            $graphQLSchemaConfigurationCustomPostType = $this->instanceManager->getInstance(GraphQLSchemaConfigurationCustomPostType::class);
            $this->graphQLSchemaConfigurationCustomPostType = $graphQLSchemaConfigurationCustomPostType;
        }
        return $this->graphQLSchemaConfigurationCustomPostType;
    }
    final protected function getModuleRegistry(): ModuleRegistryInterface
    {
        if ($this->moduleRegistry === null) {
            /** @var ModuleRegistryInterface */
            $moduleRegistry = $this->instanceManager->getInstance(ModuleRegistryInterface::class);
            $this->moduleRegistry = $moduleRegistry;
        }
        return $this->moduleRegistry;
    }

    public function isServiceEnabled(): bool
    {
        if (!$this->getModuleRegistry()->isModuleEnabled(SchemaConfigurationFunctionalityModuleResolver::SCHEMA_CONFIGURATION)) {
            return false;
        }
        return parent::isServiceEnabled();
    }

    /**
     * Custom Post Type for which to enable the block category
     *
     * @return string[]
     */
    public function getCustomPostTypes(): array
    {
        return [
            $this->getGraphQLSchemaConfigurationCustomPostType()->getCustomPostType(),
        ];
    }

    /**
     * Block category's slug
     */
    protected function getBlockCategorySlug(): string
    {
        return self::SCHEMA_CONFIGURATION_BLOCK_CATEGORY;
    }

    /**
     * Block category's title
     */
    protected function getBlockCategoryTitle(): string
    {
        return __('Schema Configuration for GraphQL', 'gatographql');
    }
}
