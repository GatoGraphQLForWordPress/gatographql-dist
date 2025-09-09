<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectModels;

use stdClass;
/** @internal */
final class GenericErrorPayload extends \PoPSchema\SchemaCommons\ObjectModels\AbstractErrorPayload implements \PoPSchema\SchemaCommons\ObjectModels\GenericErrorPayloadInterface
{
    public function __construct(string $message, public readonly ?string $code = null, public readonly ?stdClass $data = null)
    {
        parent::__construct($message);
    }
    public function getCode() : ?string
    {
        return $this->code;
    }
    public function getData() : ?stdClass
    {
        return $this->data;
    }
}
