<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectModels;

/**
 * Mutations that do not modify an object, such as `Root._sendEmail`
 * @internal
 */
final class MutationPayload extends \PoPSchema\SchemaCommons\ObjectModels\AbstractTransientOperationPayload
{
}
