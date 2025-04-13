<?php

// scoper-autoload.php @generated by PhpScoper

$loader = (static function () {
    // Backup the autoloaded Composer files
    $existingComposerAutoloadFiles = $GLOBALS['__composer_autoload_files'] ?? [];

    $loader = require_once __DIR__.'/autoload.php';
    // Ensure InstalledVersions is available
    $installedVersionsPath = __DIR__.'/composer/InstalledVersions.php';
    if (file_exists($installedVersionsPath)) require_once $installedVersionsPath;

    // Restore the backup and ensure the excluded files are properly marked as loaded
    $GLOBALS['__composer_autoload_files'] = \array_merge(
        $existingComposerAutoloadFiles,
        \array_fill_keys([], true)
    );

    return $loader;
})();

// Class aliases. For more information see:
// https://github.com/humbug/php-scoper/blob/master/docs/further-reading.md#class-aliases
if (!function_exists('humbug_phpscoper_expose_class')) {
    function humbug_phpscoper_expose_class($exposed, $prefixed) {
        if (!class_exists($exposed, false) && !interface_exists($exposed, false) && !trait_exists($exposed, false)) {
            spl_autoload_call($prefixed);
        }
    }
}
humbug_phpscoper_expose_class('CastToType', 'GatoExternalPrefixByGatoGraphQL\CastToType');
humbug_phpscoper_expose_class('ComposerAutoloaderInitab69ff52dcc68f48b3cae20895d82140', 'GatoExternalPrefixByGatoGraphQL\ComposerAutoloaderInitab69ff52dcc68f48b3cae20895d82140');
humbug_phpscoper_expose_class('DateInvalidTimeZoneException', 'GatoExternalPrefixByGatoGraphQL\DateInvalidTimeZoneException');
humbug_phpscoper_expose_class('DateMalformedStringException', 'GatoExternalPrefixByGatoGraphQL\DateMalformedStringException');
humbug_phpscoper_expose_class('DateException', 'GatoExternalPrefixByGatoGraphQL\DateException');
humbug_phpscoper_expose_class('DateMalformedIntervalStringException', 'GatoExternalPrefixByGatoGraphQL\DateMalformedIntervalStringException');
humbug_phpscoper_expose_class('DateObjectError', 'GatoExternalPrefixByGatoGraphQL\DateObjectError');
humbug_phpscoper_expose_class('Override', 'GatoExternalPrefixByGatoGraphQL\Override');
humbug_phpscoper_expose_class('SQLite3Exception', 'GatoExternalPrefixByGatoGraphQL\SQLite3Exception');
humbug_phpscoper_expose_class('DateRangeError', 'GatoExternalPrefixByGatoGraphQL\DateRangeError');
humbug_phpscoper_expose_class('DateMalformedPeriodStringException', 'GatoExternalPrefixByGatoGraphQL\DateMalformedPeriodStringException');
humbug_phpscoper_expose_class('DateInvalidOperationException', 'GatoExternalPrefixByGatoGraphQL\DateInvalidOperationException');
humbug_phpscoper_expose_class('DateError', 'GatoExternalPrefixByGatoGraphQL\DateError');
humbug_phpscoper_expose_class('Attribute', 'GatoExternalPrefixByGatoGraphQL\Attribute');
humbug_phpscoper_expose_class('Stringable', 'GatoExternalPrefixByGatoGraphQL\Stringable');
humbug_phpscoper_expose_class('UnhandledMatchError', 'GatoExternalPrefixByGatoGraphQL\UnhandledMatchError');
humbug_phpscoper_expose_class('PhpToken', 'GatoExternalPrefixByGatoGraphQL\PhpToken');
humbug_phpscoper_expose_class('ValueError', 'GatoExternalPrefixByGatoGraphQL\ValueError');
humbug_phpscoper_expose_class('�', 'GatoExternalPrefixByGatoGraphQL\�');

// Function aliases. For more information see:
// https://github.com/humbug/php-scoper/blob/master/docs/further-reading.md#function-aliases
// if (!function_exists('__')) { function __() { return \GatoExternalPrefixByGatoGraphQL\__(...func_get_args()); } }
// if (!function_exists('ctype_alnum')) { function ctype_alnum() { return \GatoExternalPrefixByGatoGraphQL\ctype_alnum(...func_get_args()); } }
// if (!function_exists('ctype_alpha')) { function ctype_alpha() { return \GatoExternalPrefixByGatoGraphQL\ctype_alpha(...func_get_args()); } }
// if (!function_exists('ctype_cntrl')) { function ctype_cntrl() { return \GatoExternalPrefixByGatoGraphQL\ctype_cntrl(...func_get_args()); } }
// if (!function_exists('ctype_digit')) { function ctype_digit() { return \GatoExternalPrefixByGatoGraphQL\ctype_digit(...func_get_args()); } }
// if (!function_exists('ctype_graph')) { function ctype_graph() { return \GatoExternalPrefixByGatoGraphQL\ctype_graph(...func_get_args()); } }
// if (!function_exists('ctype_lower')) { function ctype_lower() { return \GatoExternalPrefixByGatoGraphQL\ctype_lower(...func_get_args()); } }
// if (!function_exists('ctype_print')) { function ctype_print() { return \GatoExternalPrefixByGatoGraphQL\ctype_print(...func_get_args()); } }
// if (!function_exists('ctype_punct')) { function ctype_punct() { return \GatoExternalPrefixByGatoGraphQL\ctype_punct(...func_get_args()); } }
// if (!function_exists('ctype_space')) { function ctype_space() { return \GatoExternalPrefixByGatoGraphQL\ctype_space(...func_get_args()); } }
// if (!function_exists('ctype_upper')) { function ctype_upper() { return \GatoExternalPrefixByGatoGraphQL\ctype_upper(...func_get_args()); } }
// if (!function_exists('ctype_xdigit')) { function ctype_xdigit() { return \GatoExternalPrefixByGatoGraphQL\ctype_xdigit(...func_get_args()); } }
// if (!function_exists('fdiv')) { function fdiv() { return \GatoExternalPrefixByGatoGraphQL\fdiv(...func_get_args()); } }
// if (!function_exists('get_debug_type')) { function get_debug_type() { return \GatoExternalPrefixByGatoGraphQL\get_debug_type(...func_get_args()); } }
// if (!function_exists('get_mangled_object_vars')) { function get_mangled_object_vars() { return \GatoExternalPrefixByGatoGraphQL\get_mangled_object_vars(...func_get_args()); } }
// if (!function_exists('get_resource_id')) { function get_resource_id() { return \GatoExternalPrefixByGatoGraphQL\get_resource_id(...func_get_args()); } }
// if (!function_exists('getallheaders')) { function getallheaders() { return \GatoExternalPrefixByGatoGraphQL\getallheaders(...func_get_args()); } }
// if (!function_exists('headers_send')) { function headers_send() { return \GatoExternalPrefixByGatoGraphQL\headers_send(...func_get_args()); } }
// if (!function_exists('includeIfExists')) { function includeIfExists() { return \GatoExternalPrefixByGatoGraphQL\includeIfExists(...func_get_args()); } }
// if (!function_exists('json_validate')) { function json_validate() { return \GatoExternalPrefixByGatoGraphQL\json_validate(...func_get_args()); } }
// if (!function_exists('ldap_connect_wallet')) { function ldap_connect_wallet() { return \GatoExternalPrefixByGatoGraphQL\ldap_connect_wallet(...func_get_args()); } }
// if (!function_exists('ldap_exop_sync')) { function ldap_exop_sync() { return \GatoExternalPrefixByGatoGraphQL\ldap_exop_sync(...func_get_args()); } }
// if (!function_exists('litespeed_finish_request')) { function litespeed_finish_request() { return \GatoExternalPrefixByGatoGraphQL\litespeed_finish_request(...func_get_args()); } }
// if (!function_exists('mb_check_encoding')) { function mb_check_encoding() { return \GatoExternalPrefixByGatoGraphQL\mb_check_encoding(...func_get_args()); } }
// if (!function_exists('mb_chr')) { function mb_chr() { return \GatoExternalPrefixByGatoGraphQL\mb_chr(...func_get_args()); } }
// if (!function_exists('mb_convert_case')) { function mb_convert_case() { return \GatoExternalPrefixByGatoGraphQL\mb_convert_case(...func_get_args()); } }
// if (!function_exists('mb_convert_encoding')) { function mb_convert_encoding() { return \GatoExternalPrefixByGatoGraphQL\mb_convert_encoding(...func_get_args()); } }
// if (!function_exists('mb_convert_variables')) { function mb_convert_variables() { return \GatoExternalPrefixByGatoGraphQL\mb_convert_variables(...func_get_args()); } }
// if (!function_exists('mb_decode_mimeheader')) { function mb_decode_mimeheader() { return \GatoExternalPrefixByGatoGraphQL\mb_decode_mimeheader(...func_get_args()); } }
// if (!function_exists('mb_decode_numericentity')) { function mb_decode_numericentity() { return \GatoExternalPrefixByGatoGraphQL\mb_decode_numericentity(...func_get_args()); } }
// if (!function_exists('mb_detect_encoding')) { function mb_detect_encoding() { return \GatoExternalPrefixByGatoGraphQL\mb_detect_encoding(...func_get_args()); } }
// if (!function_exists('mb_detect_order')) { function mb_detect_order() { return \GatoExternalPrefixByGatoGraphQL\mb_detect_order(...func_get_args()); } }
// if (!function_exists('mb_encode_mimeheader')) { function mb_encode_mimeheader() { return \GatoExternalPrefixByGatoGraphQL\mb_encode_mimeheader(...func_get_args()); } }
// if (!function_exists('mb_encode_numericentity')) { function mb_encode_numericentity() { return \GatoExternalPrefixByGatoGraphQL\mb_encode_numericentity(...func_get_args()); } }
// if (!function_exists('mb_encoding_aliases')) { function mb_encoding_aliases() { return \GatoExternalPrefixByGatoGraphQL\mb_encoding_aliases(...func_get_args()); } }
// if (!function_exists('mb_get_info')) { function mb_get_info() { return \GatoExternalPrefixByGatoGraphQL\mb_get_info(...func_get_args()); } }
// if (!function_exists('mb_http_input')) { function mb_http_input() { return \GatoExternalPrefixByGatoGraphQL\mb_http_input(...func_get_args()); } }
// if (!function_exists('mb_http_output')) { function mb_http_output() { return \GatoExternalPrefixByGatoGraphQL\mb_http_output(...func_get_args()); } }
// if (!function_exists('mb_internal_encoding')) { function mb_internal_encoding() { return \GatoExternalPrefixByGatoGraphQL\mb_internal_encoding(...func_get_args()); } }
// if (!function_exists('mb_language')) { function mb_language() { return \GatoExternalPrefixByGatoGraphQL\mb_language(...func_get_args()); } }
// if (!function_exists('mb_lcfirst')) { function mb_lcfirst() { return \GatoExternalPrefixByGatoGraphQL\mb_lcfirst(...func_get_args()); } }
// if (!function_exists('mb_list_encodings')) { function mb_list_encodings() { return \GatoExternalPrefixByGatoGraphQL\mb_list_encodings(...func_get_args()); } }
// if (!function_exists('mb_ltrim')) { function mb_ltrim() { return \GatoExternalPrefixByGatoGraphQL\mb_ltrim(...func_get_args()); } }
// if (!function_exists('mb_ord')) { function mb_ord() { return \GatoExternalPrefixByGatoGraphQL\mb_ord(...func_get_args()); } }
// if (!function_exists('mb_output_handler')) { function mb_output_handler() { return \GatoExternalPrefixByGatoGraphQL\mb_output_handler(...func_get_args()); } }
// if (!function_exists('mb_parse_str')) { function mb_parse_str() { return \GatoExternalPrefixByGatoGraphQL\mb_parse_str(...func_get_args()); } }
// if (!function_exists('mb_rtrim')) { function mb_rtrim() { return \GatoExternalPrefixByGatoGraphQL\mb_rtrim(...func_get_args()); } }
// if (!function_exists('mb_scrub')) { function mb_scrub() { return \GatoExternalPrefixByGatoGraphQL\mb_scrub(...func_get_args()); } }
// if (!function_exists('mb_str_pad')) { function mb_str_pad() { return \GatoExternalPrefixByGatoGraphQL\mb_str_pad(...func_get_args()); } }
// if (!function_exists('mb_str_split')) { function mb_str_split() { return \GatoExternalPrefixByGatoGraphQL\mb_str_split(...func_get_args()); } }
// if (!function_exists('mb_stripos')) { function mb_stripos() { return \GatoExternalPrefixByGatoGraphQL\mb_stripos(...func_get_args()); } }
// if (!function_exists('mb_stristr')) { function mb_stristr() { return \GatoExternalPrefixByGatoGraphQL\mb_stristr(...func_get_args()); } }
// if (!function_exists('mb_strlen')) { function mb_strlen() { return \GatoExternalPrefixByGatoGraphQL\mb_strlen(...func_get_args()); } }
// if (!function_exists('mb_strpos')) { function mb_strpos() { return \GatoExternalPrefixByGatoGraphQL\mb_strpos(...func_get_args()); } }
// if (!function_exists('mb_strrchr')) { function mb_strrchr() { return \GatoExternalPrefixByGatoGraphQL\mb_strrchr(...func_get_args()); } }
// if (!function_exists('mb_strrichr')) { function mb_strrichr() { return \GatoExternalPrefixByGatoGraphQL\mb_strrichr(...func_get_args()); } }
// if (!function_exists('mb_strripos')) { function mb_strripos() { return \GatoExternalPrefixByGatoGraphQL\mb_strripos(...func_get_args()); } }
// if (!function_exists('mb_strrpos')) { function mb_strrpos() { return \GatoExternalPrefixByGatoGraphQL\mb_strrpos(...func_get_args()); } }
// if (!function_exists('mb_strstr')) { function mb_strstr() { return \GatoExternalPrefixByGatoGraphQL\mb_strstr(...func_get_args()); } }
// if (!function_exists('mb_strtolower')) { function mb_strtolower() { return \GatoExternalPrefixByGatoGraphQL\mb_strtolower(...func_get_args()); } }
// if (!function_exists('mb_strtoupper')) { function mb_strtoupper() { return \GatoExternalPrefixByGatoGraphQL\mb_strtoupper(...func_get_args()); } }
// if (!function_exists('mb_strwidth')) { function mb_strwidth() { return \GatoExternalPrefixByGatoGraphQL\mb_strwidth(...func_get_args()); } }
// if (!function_exists('mb_substitute_character')) { function mb_substitute_character() { return \GatoExternalPrefixByGatoGraphQL\mb_substitute_character(...func_get_args()); } }
// if (!function_exists('mb_substr')) { function mb_substr() { return \GatoExternalPrefixByGatoGraphQL\mb_substr(...func_get_args()); } }
// if (!function_exists('mb_substr_count')) { function mb_substr_count() { return \GatoExternalPrefixByGatoGraphQL\mb_substr_count(...func_get_args()); } }
// if (!function_exists('mb_trim')) { function mb_trim() { return \GatoExternalPrefixByGatoGraphQL\mb_trim(...func_get_args()); } }
// if (!function_exists('mb_ucfirst')) { function mb_ucfirst() { return \GatoExternalPrefixByGatoGraphQL\mb_ucfirst(...func_get_args()); } }
// if (!function_exists('password_algos')) { function password_algos() { return \GatoExternalPrefixByGatoGraphQL\password_algos(...func_get_args()); } }
// if (!function_exists('preg_last_error_msg')) { function preg_last_error_msg() { return \GatoExternalPrefixByGatoGraphQL\preg_last_error_msg(...func_get_args()); } }
// if (!function_exists('str_contains')) { function str_contains() { return \GatoExternalPrefixByGatoGraphQL\str_contains(...func_get_args()); } }
// if (!function_exists('str_decrement')) { function str_decrement() { return \GatoExternalPrefixByGatoGraphQL\str_decrement(...func_get_args()); } }
// if (!function_exists('str_ends_with')) { function str_ends_with() { return \GatoExternalPrefixByGatoGraphQL\str_ends_with(...func_get_args()); } }
// if (!function_exists('str_increment')) { function str_increment() { return \GatoExternalPrefixByGatoGraphQL\str_increment(...func_get_args()); } }
// if (!function_exists('str_starts_with')) { function str_starts_with() { return \GatoExternalPrefixByGatoGraphQL\str_starts_with(...func_get_args()); } }
// if (!function_exists('stream_context_set_options')) { function stream_context_set_options() { return \GatoExternalPrefixByGatoGraphQL\stream_context_set_options(...func_get_args()); } }

return $loader;
