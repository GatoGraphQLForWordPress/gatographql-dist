<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Marketplace\Constants;

class LicenseStatus
{
    /** The license key has one or more activations */
    public const ACTIVE = 'active';

    /** The license key's expiry date has passed, either because the related product had a defined license length or because the license's subscription has expired */
    public const EXPIRED = 'expired';

    /** The license key is valid but has no activations */
    public const INACTIVE = 'inactive';

    /** The license key has been manually disabled */
    public const DISABLED = 'disabled';

    /** The license is "inactive", "disabled", or any other */
    public const OTHER = 'other';
}
