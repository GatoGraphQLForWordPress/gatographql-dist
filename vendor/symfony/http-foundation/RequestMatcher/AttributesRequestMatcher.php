<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\RequestMatcher;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Request;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\RequestMatcherInterface;
/**
 * Checks the Request attributes matches all regular expressions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
class AttributesRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var array<string, string>
     */
    private $regexps;
    /**
     * @param array<string, string> $regexps
     */
    public function __construct(array $regexps)
    {
        $this->regexps = $regexps;
    }
    public function matches(Request $request) : bool
    {
        foreach ($this->regexps as $key => $regexp) {
            $attribute = $request->attributes->get($key);
            if (!\is_string($attribute)) {
                return \false;
            }
            if (!\preg_match('{' . $regexp . '}', $attribute)) {
                return \false;
            }
        }
        return \true;
    }
}
