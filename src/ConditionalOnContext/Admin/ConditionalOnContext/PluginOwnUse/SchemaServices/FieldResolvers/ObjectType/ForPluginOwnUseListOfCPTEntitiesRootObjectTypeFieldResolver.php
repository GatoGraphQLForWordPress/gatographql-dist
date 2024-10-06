<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ConditionalOnContext\Admin\ConditionalOnContext\PluginOwnUse\SchemaServices\FieldResolvers\ObjectType;

use GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\GraphQLSchemaConfigurationCustomPostType;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;

/**
 * ObjectTypeFieldResolver for the Custom Post Types from this plugin
 */
class ForPluginOwnUseListOfCPTEntitiesRootObjectTypeFieldResolver extends AbstractForPluginOwnUseListOfCPTEntitiesRootObjectTypeFieldResolver
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\CustomPostTypes\GraphQLSchemaConfigurationCustomPostType|null
     */
    private $graphQLSchemaConfigurationCustomPostType;

    final public function setGraphQLSchemaConfigurationCustomPostType(GraphQLSchemaConfigurationCustomPostType $graphQLSchemaConfigurationCustomPostType): void
    {
        $this->graphQLSchemaConfigurationCustomPostType = $graphQLSchemaConfigurationCustomPostType;
    }
    final protected function getGraphQLSchemaConfigurationCustomPostType(): GraphQLSchemaConfigurationCustomPostType
    {
        if ($this->graphQLSchemaConfigurationCustomPostType === null) {
            /** @var GraphQLSchemaConfigurationCustomPostType */
            $graphQLSchemaConfigurationCustomPostType = $this->instanceManager->getInstance(GraphQLSchemaConfigurationCustomPostType::class);
            $this->graphQLSchemaConfigurationCustomPostType = $graphQLSchemaConfigurationCustomPostType;
        }
        return $this->graphQLSchemaConfigurationCustomPostType;
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'schemaConfigurations',
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'schemaConfigurations':
                return $this->__('Schema Configurations', 'gatographql');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }

    protected function getFieldCustomPostType(FieldDataAccessorInterface $fieldDataAccessor): string
    {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'schemaConfigurations':
                return $this->getGraphQLSchemaConfigurationCustomPostType()->getCustomPostType();
            default:
                return '';
        }
    }
}
