<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\HttpFoundation\RequestMatcher;

use PrefixedByPoP\Symfony\Component\HttpFoundation\Request;
use PrefixedByPoP\Symfony\Component\HttpFoundation\RequestMatcherInterface;
/**
 * Checks the Request URL host name matches a regular expression.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
class HostRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var string
     */
    private $regexp;
    public function __construct(string $regexp)
    {
        $this->regexp = $regexp;
    }
    public function matches(Request $request) : bool
    {
        return \preg_match('{' . $this->regexp . '}i', $request->getHost());
    }
}
