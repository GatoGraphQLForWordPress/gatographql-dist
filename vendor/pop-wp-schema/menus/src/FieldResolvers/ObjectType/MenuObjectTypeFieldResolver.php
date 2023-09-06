<?php

declare(strict_types=1);

namespace PoPWPSchema\Menus\FieldResolvers\ObjectType;

use PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuObjectTypeResolver;
use PoPWPSchema\Menus\TypeResolvers\ScalarType\MenuLocationEnumStringScalarTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use WP_Term;

class MenuObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPWPSchema\Menus\TypeResolvers\ScalarType\MenuLocationEnumStringScalarTypeResolver|null
     */
    private $menuLocationEnumStringScalarTypeResolver;

    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    final public function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver): void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    final protected function getIntScalarTypeResolver(): IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    final public function setMenuLocationEnumStringTypeResolver(MenuLocationEnumStringScalarTypeResolver $menuLocationEnumStringScalarTypeResolver): void
    {
        $this->menuLocationEnumStringScalarTypeResolver = $menuLocationEnumStringScalarTypeResolver;
    }
    final protected function getMenuLocationEnumStringTypeResolver(): MenuLocationEnumStringScalarTypeResolver
    {
        if ($this->menuLocationEnumStringScalarTypeResolver === null) {
            /** @var MenuLocationEnumStringScalarTypeResolver */
            $menuLocationEnumStringScalarTypeResolver = $this->instanceManager->getInstance(MenuLocationEnumStringScalarTypeResolver::class);
            $this->menuLocationEnumStringScalarTypeResolver = $menuLocationEnumStringScalarTypeResolver;
        }
        return $this->menuLocationEnumStringScalarTypeResolver;
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            MenuObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'name',
            'slug',
            'count',
            'locations',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
            case 'slug':
                return $this->getStringScalarTypeResolver();
            case 'locations':
                return $this->getMenuLocationEnumStringTypeResolver();
            case 'count':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        switch ($fieldName) {
            case 'count':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'locations':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Menu\'s name', 'pop-menus');
            case 'slug':
                return $this->__('Menu\'s slug', 'pop-menus');
            case 'count':
                return $this->__('Number of items contained in the menu', 'pop-menus');
            case 'locations':
                return $this->__('To which locations has the menu been assigned to', 'pop-menus');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }

    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var WP_Term */
        $menu = $object;
        $menuID = $objectTypeResolver->getID($menu);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'name':
                return $menu->name;
            case 'slug':
                return $menu->slug;
            case 'count':
                return $menu->count;
            case 'locations':
                $locationMenuIDs = \get_nav_menu_locations();
                return array_keys(
                    array_filter(
                        $locationMenuIDs,
                        function ($locationMenuID) use ($menuID) {
                            return $locationMenuID === $menuID;
                        }
                    )
                );
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
