<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Constants;

class HookNames
{
    public const QUERYABLE_CUSTOMPOST_TYPES = __CLASS__ . ':queryable-custompost-types';
    public const REJECTED_QUERYABLE_CUSTOMPOST_TYPES = __CLASS__ . ':rejected-queryable-custompost-types';
    public const QUERYABLE_TAG_TAXONOMIES = __CLASS__ . ':queryable-tag-taxonomies';
    public const REJECTED_QUERYABLE_TAG_TAXONOMIES = __CLASS__ . ':rejected-queryable-tag-taxonomies';
    public const QUERYABLE_CATEGORY_TAXONOMIES = __CLASS__ . ':queryable-category-taxonomies';
    public const REJECTED_QUERYABLE_CATEGORY_TAXONOMIES = __CLASS__ . ':rejected-queryable-category-taxonomies';

    public const ADMIN_ENDPOINT_GROUP_MODULE_CONFIGURATION = __CLASS__ . ':admin-endpoint-group-module-configuration';
    public const ADMIN_ENDPOINT_GROUP_MODULE_CLASSES_TO_SKIP = __CLASS__ . ':admin-endpoint-group-module-classes-to-skip';

    public const SUPPORTED_ADMIN_ENDPOINT_GROUPS = __CLASS__ . ':supported-admin-endpoint-groups';

    public const FORBID_ACCESS = __CLASS__ . ':forbid-access';
}
