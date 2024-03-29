<?php

declare (strict_types=1);
namespace PoP\Root\Translation;

/** @internal */
class BasicTranslationAPI implements \PoP\Root\Translation\TranslationAPIInterface
{
    public function __(string $text, string $domain = 'default') : string
    {
        return $text;
    }
}
