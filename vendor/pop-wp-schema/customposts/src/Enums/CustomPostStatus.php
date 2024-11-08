<?php

declare(strict_types=1);

namespace PoPWPSchema\CustomPosts\Enums;

use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus as UpstreamCustomPostStatus;

class CustomPostStatus extends UpstreamCustomPostStatus
{
    public const FUTURE = 'future';
    public const PRIVATE = 'private';
    public const INHERIT = 'inherit';
    public const ANY = 'any';
    /**
     * @todo "auto-draft" must be converted to enum value "auto_draft" on `Post.status`.
     *       Until then, this code is commented
     * @see NonEnumerableCustomPostStatus.php
     */
    //public final const AUTO_DRAFT = 'auto_draft';
}
