<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts;

/** @internal */
class Environment
{
    public const ALLOW_QUERYING_PRIVATE_CPTS = 'ALLOW_QUERYING_PRIVATE_CPTS';
    public const CUSTOMPOST_LIST_DEFAULT_LIMIT = 'CUSTOMPOST_LIST_DEFAULT_LIMIT';
    public const CUSTOMPOST_LIST_MAX_LIMIT = 'CUSTOMPOST_LIST_MAX_LIMIT';
    public const USE_SINGLE_TYPE_INSTEAD_OF_CUSTOMPOST_UNION_TYPE = 'USE_SINGLE_TYPE_INSTEAD_OF_CUSTOMPOST_UNION_TYPE';
    public const TREAT_CUSTOMPOST_STATUS_AS_SENSITIVE_DATA = 'TREAT_CUSTOMPOST_STATUS_AS_SENSITIVE_DATA';
    public const TREAT_CUSTOMPOST_RAW_CONTENT_FIELDS_AS_SENSITIVE_DATA = 'TREAT_CUSTOMPOST_RAW_CONTENT_FIELDS_AS_SENSITIVE_DATA';
    public const QUERYABLE_CUSTOMPOST_TYPES = 'QUERYABLE_CUSTOMPOST_TYPES';
    public const DISABLE_PACKAGES_ADDING_DEFAULT_QUERYABLE_CUSTOMPOST_TYPES = 'DISABLE_PACKAGES_ADDING_DEFAULT_QUERYABLE_CUSTOMPOST_TYPES';
}
