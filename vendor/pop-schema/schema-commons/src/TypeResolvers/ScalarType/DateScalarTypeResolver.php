<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

use DateTimeInterface;
/** @internal */
class DateScalarTypeResolver extends \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\AbstractDateTimeScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'Date';
    }
    protected function getDateTimeFormat() : string
    {
        return 'Y-m-d';
    }
    /**
     * @return string[]
     */
    protected function getDateTimeInputFormats() : array
    {
        return \array_merge(parent::getDateTimeInputFormats(), [DateTimeInterface::ATOM]);
    }
}
