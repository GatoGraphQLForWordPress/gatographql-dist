<?php

declare (strict_types=1);
namespace PoP\DOMCrawler;

use DOMNodeList;
use DOMNode;
/** @internal */
interface CrawlerFactoryInterface
{
    /**
     * @param DOMNodeList|DOMNode|DOMNode[]|string|null $node A Node to use as the base for the crawling
     */
    public function createCrawler($node = null, string $uri = null, string $baseHref = null, bool $useHtml5Parser = \true) : \PoP\DOMCrawler\Crawler;
}
