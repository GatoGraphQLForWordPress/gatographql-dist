<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\Enums;

/** @internal */
enum Behaviors : string
{
    case ALLOW = 'allow';
    case DENY = 'deny';
}
