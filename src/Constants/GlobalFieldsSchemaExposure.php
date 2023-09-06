<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Constants;

class GlobalFieldsSchemaExposure
{
    public const DO_NOT_EXPOSE = 'do-not-expose';
    public const EXPOSE_IN_ROOT_TYPE_ONLY = 'expose-in-root-type-only';
    public const EXPOSE_IN_ALL_TYPES = 'expose-in-all-types';
}
