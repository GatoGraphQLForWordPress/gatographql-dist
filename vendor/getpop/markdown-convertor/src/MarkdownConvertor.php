<?php

declare (strict_types=1);
namespace PoP\MarkdownConvertor;

use GatoExternalPrefixByGatoGraphQL\Michelf\MarkdownExtra;
/**
 * Markdown formatter provided by `michelf/php-markdown`
 *
 * @see https://michelf.ca/projects/php-markdown/extra/
 * @internal
 */
class MarkdownConvertor implements \PoP\MarkdownConvertor\MarkdownConvertorInterface
{
    /**
     * Parse the file's Markdown into HTML Content
     */
    public function convertMarkdownToHTML(string $markdownContent) : string
    {
        return MarkdownExtra::defaultTransform($markdownContent);
    }
}
