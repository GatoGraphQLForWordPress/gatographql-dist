<?php

declare (strict_types=1);
namespace PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoPCMSSchema\Taxonomies\Constants\TaxonomyOrderBy;
use PoPCMSSchema\Taxonomies\TypeResolvers\EnumType\TaxonomyOrderByEnumTypeResolver;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\SortInputObjectTypeResolver;
/** @internal */
class TaxonomySortInputObjectTypeResolver extends SortInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\EnumType\TaxonomyOrderByEnumTypeResolver|null
     */
    private $taxonomySortByEnumTypeResolver;
    public final function setTaxonomyOrderByEnumTypeResolver(TaxonomyOrderByEnumTypeResolver $taxonomySortByEnumTypeResolver) : void
    {
        $this->taxonomySortByEnumTypeResolver = $taxonomySortByEnumTypeResolver;
    }
    protected final function getTaxonomyOrderByEnumTypeResolver() : TaxonomyOrderByEnumTypeResolver
    {
        if ($this->taxonomySortByEnumTypeResolver === null) {
            /** @var TaxonomyOrderByEnumTypeResolver */
            $taxonomySortByEnumTypeResolver = $this->instanceManager->getInstance(TaxonomyOrderByEnumTypeResolver::class);
            $this->taxonomySortByEnumTypeResolver = $taxonomySortByEnumTypeResolver;
        }
        return $this->taxonomySortByEnumTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'TaxonomySortInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['by' => $this->getTaxonomyOrderByEnumTypeResolver()]);
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'by':
                return TaxonomyOrderBy::NAME;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
}
