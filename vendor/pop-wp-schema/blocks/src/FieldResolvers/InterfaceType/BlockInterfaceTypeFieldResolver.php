<?php

declare(strict_types=1);

namespace PoPWPSchema\Blocks\FieldResolvers\InterfaceType;

use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver;
use PoPWPSchema\Blocks\TypeHelpers\BlockUnionTypeHelpers;
use PoPWPSchema\Blocks\TypeResolvers\InterfaceType\BlockInterfaceTypeResolver;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver;

class BlockInterfaceTypeFieldResolver extends AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver|null
     */
    private $jsonObjectScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver|null
     */
    private $htmlScalarTypeResolver;

    final public function setJSONObjectScalarTypeResolver(JSONObjectScalarTypeResolver $jsonObjectScalarTypeResolver): void
    {
        $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
    }
    final protected function getJSONObjectScalarTypeResolver(): JSONObjectScalarTypeResolver
    {
        if ($this->jsonObjectScalarTypeResolver === null) {
            /** @var JSONObjectScalarTypeResolver */
            $jsonObjectScalarTypeResolver = $this->instanceManager->getInstance(JSONObjectScalarTypeResolver::class);
            $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
        }
        return $this->jsonObjectScalarTypeResolver;
    }
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
    final public function setHTMLScalarTypeResolver(HTMLScalarTypeResolver $htmlScalarTypeResolver): void
    {
        $this->htmlScalarTypeResolver = $htmlScalarTypeResolver;
    }
    final protected function getHTMLScalarTypeResolver(): HTMLScalarTypeResolver
    {
        if ($this->htmlScalarTypeResolver === null) {
            /** @var HTMLScalarTypeResolver */
            $htmlScalarTypeResolver = $this->instanceManager->getInstance(HTMLScalarTypeResolver::class);
            $this->htmlScalarTypeResolver = $htmlScalarTypeResolver;
        }
        return $this->htmlScalarTypeResolver;
    }

    /**
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo(): array
    {
        return [
            BlockInterfaceTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToImplement(): array
    {
        return [
            'name',
            'attributes',
            'innerBlocks',
            // 'innerHTML',
            'contentSource',
        ];
    }

    public function getFieldTypeResolver(string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
                return $this->getStringScalarTypeResolver();
            case 'attributes':
                return $this->getJSONObjectScalarTypeResolver();
            case 'innerBlocks':
                return BlockUnionTypeHelpers::getBlockUnionOrTargetObjectTypeResolver();
            case 'contentSource':
                return $this->getHTMLScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }

    public function getFieldTypeModifiers(string $fieldName): int
    {
        switch ($fieldName) {
            case 'name':
            case 'contentSource':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'innerBlocks':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }

    public function getFieldDescription(string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Block name', 'blocks');
            case 'attributes':
                return $this->__('Block attributes, parsed to the type declared in their block.json schema', 'blocks');
            case 'innerBlocks':
                return $this->__('Block\'s inner blocks (if suitable)', 'blocks');
            case 'contentSource':
                return $this->__('Block\'s whole HTML code, including the block comment delimiters', 'blocks');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
