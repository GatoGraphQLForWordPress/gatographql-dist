<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

/** @internal */
class IntValueJSONObjectScalarTypeResolver extends \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\AbstractScalarValueJSONObjectScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'IntValueJSONObject';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Custom scalar representing a JSON Object where values are integers', 'extended-schema-commons');
    }
    /**
     * @param string|int|float|bool $value
     */
    protected function canCastJSONObjectPropertyValue($value) : bool
    {
        return \is_numeric($value);
    }
    /**
     * @param string|int|float|bool $value
     * @return string|int|float|bool
     */
    protected function castJSONObjectPropertyValue($value)
    {
        return (int) $value;
    }
}
