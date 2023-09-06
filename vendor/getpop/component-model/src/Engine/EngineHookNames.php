<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Engine;

class EngineHookNames
{
    public const ENGINE_ITERATION_START = __CLASS__ . ':engine-iteration-start';
    public const ENGINE_ITERATION_ON_DATALOADING_COMPONENT = __CLASS__ . ':engine-iteration-on-dataloading-component';
    public const ENGINE_ITERATION_END = __CLASS__ . ':engine-iteration-end';
    public const ENTRY_COMPONENT_INITIALIZATION = __CLASS__ . ':entry-component-initialization';
    public const GENERATE_DATA_BEGINNING = __CLASS__ . ':generate-data:beginning';
    public const PROCESS_AND_GENERATE_DATA_HELPER_CALCULATIONS = __CLASS__ . ':process-and-generate-data:helper-calculations';
    public const ADD_ETAG_HEADER = __CLASS__ . ':add-etag-header';
    public const ETAG_HEADER_COMMON_CODE = __CLASS__ . ':etag-header:common-code';
    public const EXTRA_ROUTES = __CLASS__ . ':extra-routes';
    public const REQUEST_META = __CLASS__ . ':request-meta';
    public const SESSION_META = __CLASS__ . ':session-meta';
    public const SITE_META = __CLASS__ . ':site-meta';
    public const HEADERS = __CLASS__ . ':headers';
    public const PREPARE_RESPONSE = __CLASS__ . ':prepare-response';
}
