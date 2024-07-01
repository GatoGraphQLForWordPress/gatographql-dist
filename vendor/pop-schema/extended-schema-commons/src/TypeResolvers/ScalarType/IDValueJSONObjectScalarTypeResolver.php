<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

/** @internal */
class IDValueJSONObjectScalarTypeResolver extends \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\AbstractScalarValueJSONObjectScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'IDValueJSONObject';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Custom scalar representing a JSON Object where values are IDs (strings or integers)', 'extended-schema-commons');
    }
    /**
     * @param string|int|float|bool $value
     */
    protected function canCastJSONObjectPropertyValue($value) : bool
    {
        return \is_string($value) || \is_int($value);
    }
    /**
     * @param string|int|float|bool $value
     * @return string|int|float|bool
     */
    protected function castJSONObjectPropertyValue($value)
    {
        return $value;
    }
}
