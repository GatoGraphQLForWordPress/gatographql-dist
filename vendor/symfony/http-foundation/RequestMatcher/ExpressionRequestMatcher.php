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

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\ExpressionLanguage\Expression;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Request;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\RequestMatcherInterface;
/**
 * ExpressionRequestMatcher uses an expression to match a Request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
class ExpressionRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var \Symfony\Component\ExpressionLanguage\ExpressionLanguage
     */
    private $language;
    /**
     * @var \Symfony\Component\ExpressionLanguage\Expression|string
     */
    private $expression;
    /**
     * @param \Symfony\Component\ExpressionLanguage\Expression|string $expression
     */
    public function __construct(ExpressionLanguage $language, $expression)
    {
        $this->language = $language;
        $this->expression = $expression;
    }
    public function matches(Request $request) : bool
    {
        return $this->language->evaluate($this->expression, ['request' => $request, 'method' => $request->getMethod(), 'path' => \rawurldecode($request->getPathInfo()), 'host' => $request->getHost(), 'ip' => $request->getClientIp(), 'attributes' => $request->attributes->all()]);
    }
}
