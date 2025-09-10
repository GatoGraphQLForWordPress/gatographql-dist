<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

/** @internal */
class NullableListValueJSONObjectScalarTypeResolver extends \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\AbstractListValueJSONObjectScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'NullableListValueJSONObject';
    }
    protected function canValueBeNullable() : bool
    {
        return \true;
    }
}
