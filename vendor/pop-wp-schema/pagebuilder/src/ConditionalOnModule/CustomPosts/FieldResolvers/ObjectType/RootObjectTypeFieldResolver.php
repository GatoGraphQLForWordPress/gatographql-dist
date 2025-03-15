<?php

declare(strict_types=1);

namespace PoPWPSchema\PageBuilder\ConditionalOnModule\CustomPosts\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver;
use PoPWPSchema\PageBuilder\TypeAPIs\PageBuilderTypeAPIInterface;
use PoPWPSchema\PageBuilder\TypeResolvers\EnumType\PageBuilderProvidersEnumStringTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;

class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoPWPSchema\PageBuilder\TypeResolvers\EnumType\PageBuilderProvidersEnumStringTypeResolver|null
     */
    private $pageBuilderProvidersEnumStringTypeResolver;
    /**
     * @var \PoPWPSchema\PageBuilder\TypeAPIs\PageBuilderTypeAPIInterface|null
     */
    private $pageBuilderTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver|null
     */
    private $customPostEnumStringScalarTypeResolver;

    final protected function getPageBuilderProvidersEnumStringTypeResolver(): PageBuilderProvidersEnumStringTypeResolver
    {
        if ($this->pageBuilderProvidersEnumStringTypeResolver === null) {
            /** @var PageBuilderProvidersEnumStringTypeResolver */
            $pageBuilderProvidersEnumStringTypeResolver = $this->instanceManager->getInstance(PageBuilderProvidersEnumStringTypeResolver::class);
            $this->pageBuilderProvidersEnumStringTypeResolver = $pageBuilderProvidersEnumStringTypeResolver;
        }
        return $this->pageBuilderProvidersEnumStringTypeResolver;
    }
    final protected function getPageBuilderTypeAPI(): PageBuilderTypeAPIInterface
    {
        if ($this->pageBuilderTypeAPI === null) {
            /** @var PageBuilderTypeAPIInterface */
            $pageBuilderTypeAPI = $this->instanceManager->getInstance(PageBuilderTypeAPIInterface::class);
            $this->pageBuilderTypeAPI = $pageBuilderTypeAPI;
        }
        return $this->pageBuilderTypeAPI;
    }
    final protected function getCustomPostEnumStringScalarTypeResolver(): CustomPostEnumStringScalarTypeResolver
    {
        if ($this->customPostEnumStringScalarTypeResolver === null) {
            /** @var CustomPostEnumStringScalarTypeResolver */
            $customPostEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CustomPostEnumStringScalarTypeResolver::class);
            $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
        }
        return $this->customPostEnumStringScalarTypeResolver;
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            RootObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'useWhichPageBuilderWithCustomPostType',
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'useWhichPageBuilderWithCustomPostType':
                return $this->__('Indicate which Page Builder (if any) is configured to edit the custom post type, or `null` if none', 'pagebuilder');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'useWhichPageBuilderWithCustomPostType':
                return $this->getPageBuilderProvidersEnumStringTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        switch ($fieldName) {
            case 'useWhichPageBuilderWithCustomPostType':
                return [
                    'customPostType' => $this->getCustomPostEnumStringScalarTypeResolver(),
                ];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['useWhichPageBuilderWithCustomPostType' => 'customPostType']:
                return $this->__('The custom post type', 'gatographql');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }

    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['useWhichPageBuilderWithCustomPostType' => 'customPostType']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }

    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'useWhichPageBuilderWithCustomPostType':
                /** @var string */
                $customPostType = $fieldDataAccessor->getValue('customPostType');
                return $this->getPageBuilderTypeAPI()->getPageBuilderEnabledForCustomPostType($customPostType);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }

    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field): bool
    {
        return false;
    }
}
