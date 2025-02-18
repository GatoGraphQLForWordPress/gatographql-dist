<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

use DateTimeInterface;
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
