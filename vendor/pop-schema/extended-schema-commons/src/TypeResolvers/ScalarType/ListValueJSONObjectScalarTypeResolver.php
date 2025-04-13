<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

/** @internal */
class ListValueJSONObjectScalarTypeResolver extends \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\AbstractListValueJSONObjectScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'ListValueJSONObject';
    }
    protected function canValueBeNullable() : bool
    {
        return \false;
    }
}
