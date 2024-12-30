<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

/** @internal */
class StringListValueJSONObjectScalarTypeResolver extends \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\AbstractScalarListValueJSONObjectScalarTypeResolver
{
    public function getSpecifiedByURL() : ?string
    {
        return null;
    }
    public function getTypeName() : string
    {
        return 'StringListValueJSONObject';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Custom scalar representing a JSON Object where values are lists of strings (`null` values not accepted)', 'extended-schema-commons');
    }
    /**
     * @param string|int|float|bool $value
     */
    protected function canCastJSONObjectPropertyValue($value) : bool
    {
        return \true;
    }
    /**
     * @param string|int|float|bool $value
     * @return string|int|float|bool
     */
    protected function castJSONObjectPropertyValue($value)
    {
        return (string) $value;
    }
}
