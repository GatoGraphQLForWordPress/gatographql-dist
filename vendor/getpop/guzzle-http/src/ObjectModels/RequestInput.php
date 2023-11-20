<?php

declare (strict_types=1);
namespace PoP\GuzzleHTTP\ObjectModels;

/** @internal */
class RequestInput
{
    /**
     * @readonly
     * @var string
     */
    public $method;
    /**
     * @readonly
     * @var string
     */
    public $url;
    /**
     * @var array<string, mixed>
     * @readonly
     */
    public $options = [];
    /**
     * @param array<string,mixed> $options Request options. Same input as for Guzzle: https://docs.guzzlephp.org/en/stable/request-options.htm
     *
     * @see https://docs.guzzlephp.org/en/stable/request-options.htm
     */
    public function __construct(string $method, string $url, array $options = [])
    {
        $this->method = $method;
        $this->url = $url;
        $this->options = $options;
    }
}
