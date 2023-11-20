<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectModels;

use stdClass;
/** @internal */
interface GenericErrorPayloadInterface extends \PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface
{
    public function getCode() : ?string;
    public function getData() : ?stdClass;
}
