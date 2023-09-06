<?php

declare (strict_types=1);
namespace PoP\MarkdownConvertor;

use PrefixedByPoP\Michelf\MarkdownExtra;
/**
 * Markdown formatter provided by `michelf/php-markdown`
 *
 * @see https://michelf.ca/projects/php-markdown/extra/
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
