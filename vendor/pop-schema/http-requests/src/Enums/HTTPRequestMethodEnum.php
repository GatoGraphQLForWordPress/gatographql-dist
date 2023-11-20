<?php

declare (strict_types=1);
namespace PoPSchema\HTTPRequests\Enums;

/** @internal */
class HTTPRequestMethodEnum
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const PATCH = 'PATCH';
    public const HEAD = 'HEAD';
    public const OPTIONS = 'OPTIONS';
}
