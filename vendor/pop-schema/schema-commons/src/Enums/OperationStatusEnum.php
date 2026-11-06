<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\Enums;

/** @internal */
enum OperationStatusEnum : string
{
    case SUCCESS = 'SUCCESS';
    case FAILURE = 'FAILURE';
}
