<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

// @todo Replace with \DateTimeInterface. See: https://github.com/GatoGraphQL/GatoGraphQL/issues/1282
use PoPSchema\SchemaCommons\Polyfill\PHP72\DateTimeInterface;
/** @internal */
class DateTimeScalarTypeResolver extends \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\AbstractDateTimeScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'DateTime';
    }
    protected function getDateTimeFormat() : string
    {
        return DateTimeInterface::ATOM;
    }
}
