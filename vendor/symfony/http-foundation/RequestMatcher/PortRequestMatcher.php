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
 * Checks the HTTP port of a Request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
class PortRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var int
     */
    private $port;
    public function __construct(int $port)
    {
        $this->port = $port;
    }
    public function matches(Request $request) : bool
    {
        return $request->getPort() === $this->port;
    }
}
