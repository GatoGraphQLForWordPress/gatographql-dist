<?php



/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use GatoExternalPrefixByGatoGraphQL\Symfony\Polyfill\Mbstring as p;
if (\PHP_VERSION_ID >= 80000) {
    return require __DIR__ . '/bootstrap80.php';
}
if (!\function_exists('mb_convert_encoding')) {
    /** @internal */
    function mb_convert_encoding($string, $to_encoding, $from_encoding = null)
    {
        return p\Mbstring::mb_convert_encoding($string, $to_encoding, $from_encoding);
    }
}
if (!\function_exists('mb_decode_mimeheader')) {
    /** @internal */
    function mb_decode_mimeheader($string)
    {
        return p\Mbstring::mb_decode_mimeheader($string);
    }
}
if (!\function_exists('mb_encode_mimeheader')) {
    /** @internal */
    function mb_encode_mimeheader($string, $charset = null, $transfer_encoding = null, $newline = "\r\n", $indent = 0)
    {
        return p\Mbstring::mb_encode_mimeheader($string, $charset, $transfer_encoding, $newline, $indent);
    }
}
if (!\function_exists('mb_decode_numericentity')) {
    /** @internal */
    function mb_decode_numericentity($string, $map, $encoding = null)
    {
        return p\Mbstring::mb_decode_numericentity($string, $map, $encoding);
    }
}
if (!\function_exists('mb_encode_numericentity')) {
    /** @internal */
    function mb_encode_numericentity($string, $map, $encoding = null, $hex = \false)
    {
        return p\Mbstring::mb_encode_numericentity($string, $map, $encoding, $hex);
    }
}
if (!\function_exists('mb_convert_case')) {
    /** @internal */
    function mb_convert_case($string, $mode, $encoding = null)
    {
        return p\Mbstring::mb_convert_case($string, $mode, $encoding);
    }
}
if (!\function_exists('mb_internal_encoding')) {
    /** @internal */
    function mb_internal_encoding($encoding = null)
    {
        return p\Mbstring::mb_internal_encoding($encoding);
    }
}
if (!\function_exists('mb_language')) {
    /** @internal */
    function mb_language($language = null)
    {
        return p\Mbstring::mb_language($language);
    }
}
if (!\function_exists('mb_list_encodings')) {
    /** @internal */
    function mb_list_encodings()
    {
        return p\Mbstring::mb_list_encodings();
    }
}
if (!\function_exists('mb_encoding_aliases')) {
    /** @internal */
    function mb_encoding_aliases($encoding)
    {
        return p\Mbstring::mb_encoding_aliases($encoding);
    }
}
if (!\function_exists('mb_check_encoding')) {
    /** @internal */
    function mb_check_encoding($value = null, $encoding = null)
    {
        return p\Mbstring::mb_check_encoding($value, $encoding);
    }
}
if (!\function_exists('mb_detect_encoding')) {
    /** @internal */
    function mb_detect_encoding($string, $encodings = null, $strict = \false)
    {
        return p\Mbstring::mb_detect_encoding($string, $encodings, $strict);
    }
}
if (!\function_exists('mb_detect_order')) {
    /** @internal */
    function mb_detect_order($encoding = null)
    {
        return p\Mbstring::mb_detect_order($encoding);
    }
}
if (!\function_exists('mb_parse_str')) {
    /** @internal */
    function mb_parse_str($string, &$result = [])
    {
        \parse_str($string, $result);
        return (bool) $result;
    }
}
if (!\function_exists('mb_strlen')) {
    /** @internal */
    function mb_strlen($string, $encoding = null)
    {
        return p\Mbstring::mb_strlen($string, $encoding);
    }
}
if (!\function_exists('mb_strpos')) {
    /** @internal */
    function mb_strpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return p\Mbstring::mb_strpos($haystack, $needle, $offset, $encoding);
    }
}
if (!\function_exists('mb_strtolower')) {
    /** @internal */
    function mb_strtolower($string, $encoding = null)
    {
        return p\Mbstring::mb_strtolower($string, $encoding);
    }
}
if (!\function_exists('mb_strtoupper')) {
    /** @internal */
    function mb_strtoupper($string, $encoding = null)
    {
        return p\Mbstring::mb_strtoupper($string, $encoding);
    }
}
if (!\function_exists('mb_substitute_character')) {
    /** @internal */
    function mb_substitute_character($substitute_character = null)
    {
        return p\Mbstring::mb_substitute_character($substitute_character);
    }
}
if (!\function_exists('mb_substr')) {
    /** @internal */
    function mb_substr($string, $start, $length = 2147483647, $encoding = null)
    {
        return p\Mbstring::mb_substr($string, $start, $length, $encoding);
    }
}
if (!\function_exists('mb_stripos')) {
    /** @internal */
    function mb_stripos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return p\Mbstring::mb_stripos($haystack, $needle, $offset, $encoding);
    }
}
if (!\function_exists('mb_stristr')) {
    /** @internal */
    function mb_stristr($haystack, $needle, $before_needle = \false, $encoding = null)
    {
        return p\Mbstring::mb_stristr($haystack, $needle, $before_needle, $encoding);
    }
}
if (!\function_exists('mb_strrchr')) {
    /** @internal */
    function mb_strrchr($haystack, $needle, $before_needle = \false, $encoding = null)
    {
        return p\Mbstring::mb_strrchr($haystack, $needle, $before_needle, $encoding);
    }
}
if (!\function_exists('mb_strrichr')) {
    /** @internal */
    function mb_strrichr($haystack, $needle, $before_needle = \false, $encoding = null)
    {
        return p\Mbstring::mb_strrichr($haystack, $needle, $before_needle, $encoding);
    }
}
if (!\function_exists('mb_strripos')) {
    /** @internal */
    function mb_strripos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return p\Mbstring::mb_strripos($haystack, $needle, $offset, $encoding);
    }
}
if (!\function_exists('mb_strrpos')) {
    /** @internal */
    function mb_strrpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return p\Mbstring::mb_strrpos($haystack, $needle, $offset, $encoding);
    }
}
if (!\function_exists('mb_strstr')) {
    /** @internal */
    function mb_strstr($haystack, $needle, $before_needle = \false, $encoding = null)
    {
        return p\Mbstring::mb_strstr($haystack, $needle, $before_needle, $encoding);
    }
}
if (!\function_exists('mb_get_info')) {
    /** @internal */
    function mb_get_info($type = 'all')
    {
        return p\Mbstring::mb_get_info($type);
    }
}
if (!\function_exists('mb_http_output')) {
    /** @internal */
    function mb_http_output($encoding = null)
    {
        return p\Mbstring::mb_http_output($encoding);
    }
}
if (!\function_exists('mb_strwidth')) {
    /** @internal */
    function mb_strwidth($string, $encoding = null)
    {
        return p\Mbstring::mb_strwidth($string, $encoding);
    }
}
if (!\function_exists('mb_substr_count')) {
    /** @internal */
    function mb_substr_count($haystack, $needle, $encoding = null)
    {
        return p\Mbstring::mb_substr_count($haystack, $needle, $encoding);
    }
}
if (!\function_exists('mb_output_handler')) {
    /** @internal */
    function mb_output_handler($string, $status)
    {
        return p\Mbstring::mb_output_handler($string, $status);
    }
}
if (!\function_exists('mb_http_input')) {
    /** @internal */
    function mb_http_input($type = null)
    {
        return p\Mbstring::mb_http_input($type);
    }
}
if (!\function_exists('mb_convert_variables')) {
    /** @internal */
    function mb_convert_variables($to_encoding, $from_encoding, &...$vars)
    {
        return p\Mbstring::mb_convert_variables($to_encoding, $from_encoding, ...$vars);
    }
}
if (!\function_exists('mb_ord')) {
    /** @internal */
    function mb_ord($string, $encoding = null)
    {
        return p\Mbstring::mb_ord($string, $encoding);
    }
}
if (!\function_exists('mb_chr')) {
    /** @internal */
    function mb_chr($codepoint, $encoding = null)
    {
        return p\Mbstring::mb_chr($codepoint, $encoding);
    }
}
if (!\function_exists('mb_scrub')) {
    /** @internal */
    function mb_scrub($string, $encoding = null)
    {
        $encoding = null === $encoding ? \mb_internal_encoding() : $encoding;
        return \mb_convert_encoding($string, $encoding, $encoding);
    }
}
if (!\function_exists('mb_str_split')) {
    /** @internal */
    function mb_str_split($string, $length = 1, $encoding = null)
    {
        return p\Mbstring::mb_str_split($string, $length, $encoding);
    }
}
if (!\function_exists('mb_str_pad')) {
    /** @internal */
    function mb_str_pad(string $string, int $length, string $pad_string = ' ', int $pad_type = \STR_PAD_RIGHT, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_str_pad($string, $length, $pad_string, $pad_type, $encoding);
    }
}
if (!\function_exists('mb_ucfirst')) {
    /** @internal */
    function mb_ucfirst(string $string, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_ucfirst($string, $encoding);
    }
}
if (!\function_exists('mb_lcfirst')) {
    /** @internal */
    function mb_lcfirst(string $string, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_lcfirst($string, $encoding);
    }
}
if (!\function_exists('mb_trim')) {
    /** @internal */
    function mb_trim(string $string, ?string $characters = null, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_trim($string, $characters, $encoding);
    }
}
if (!\function_exists('mb_ltrim')) {
    /** @internal */
    function mb_ltrim(string $string, ?string $characters = null, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_ltrim($string, $characters, $encoding);
    }
}
if (!\function_exists('mb_rtrim')) {
    /** @internal */
    function mb_rtrim(string $string, ?string $characters = null, ?string $encoding = null) : string
    {
        return p\Mbstring::mb_rtrim($string, $characters, $encoding);
    }
}
if (\extension_loaded('mbstring')) {
    return;
}
if (!\defined('MB_CASE_UPPER')) {
    \define('MB_CASE_UPPER', 0);
}
if (!\defined('MB_CASE_LOWER')) {
    \define('MB_CASE_LOWER', 1);
}
if (!\defined('MB_CASE_TITLE')) {
    \define('MB_CASE_TITLE', 2);
}
