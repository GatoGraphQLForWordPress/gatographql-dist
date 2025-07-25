<?php

declare (strict_types=1);
namespace PoP\GuzzleHTTP\Services;

use Exception;
use GatoExternalPrefixByGatoGraphQL\GuzzleHttp\BodySummarizer;
use GatoExternalPrefixByGatoGraphQL\GuzzleHttp\Client;
use GatoExternalPrefixByGatoGraphQL\GuzzleHttp\Exception\RequestException;
use GatoExternalPrefixByGatoGraphQL\GuzzleHttp\Promise\Utils;
use GatoExternalPrefixByGatoGraphQL\GuzzleHttp\Psr7\Request;
use PoP\ComponentModel\App;
use PoP\GuzzleHTTP\Exception\GuzzleHTTPRequestException;
use PoP\GuzzleHTTP\Module;
use PoP\GuzzleHTTP\ModuleConfiguration;
use PoP\GuzzleHTTP\ObjectModels\RequestInput;
use PoP\GuzzleHTTP\UpstreamWrappers\Http\Message\ResponseInterface;
use PoP\GuzzleHTTP\UpstreamWrappers\Http\Message\ResponseWrapper;
use GatoExternalPrefixByGatoGraphQL\Psr\Http\Message\RequestInterface;
use GatoExternalPrefixByGatoGraphQL\Psr\Http\Message\ResponseInterface as UpstreamResponseInterface;
use Throwable;
/** @internal */
class GuzzleService implements \PoP\GuzzleHTTP\Services\GuzzleServiceInterface
{
    /**
     * @var \GuzzleHttp\Client|null
     */
    protected $client;
    public function setClient(Client $client) : void
    {
        $this->client = $client;
    }
    /**
     * Execute an HTTP request to the passed endpoint URL and form params
     *
     * @throws GuzzleHTTPRequestException
     */
    public function sendHTTPRequest(RequestInput $requestInput) : ResponseInterface
    {
        $client = $this->getClient();
        try {
            $response = $client->request($requestInput->method, $requestInput->url, $requestInput->options);
        } catch (Exception $exception) {
            $this->throwException($exception);
        }
        return new ResponseWrapper($response);
    }
    protected function getClient() : Client
    {
        if ($this->client === null) {
            $this->client = $this->createClient();
        }
        return $this->client;
    }
    protected function createClient() : Client
    {
        return new Client($this->getClientConfig());
    }
    /**
     * @return array<string,mixed>
     */
    protected function getClientConfig() : array
    {
        return ['headers' => $this->getClientConfigHeaders()];
    }
    /**
     * @return array<string,mixed>
     */
    protected function getClientConfigHeaders() : array
    {
        $headers = [];
        $referer = $this->getClientConfigReferer();
        if ($referer !== null) {
            $headers['Referer'] = $referer;
        }
        return $headers;
    }
    protected function getClientConfigReferer() : ?string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getGuzzleRequestReferer();
    }
    /**
     * Execute several JSON requests asynchronously
     *
     * @param RequestInput[] $requestInputs
     * @return ResponseInterface[]
     *
     * @throws GuzzleHTTPRequestException
     */
    public function sendAsyncHTTPRequest(array $requestInputs) : array
    {
        $client = $this->getClient();
        try {
            // Build the list of promises from the URLs and the body JSON queries
            $promises = [];
            foreach ($requestInputs as $requestInput) {
                $promises[] = $client->requestAsync($requestInput->method, $requestInput->url, $requestInput->options);
            }
            // Wait on all of the requests to complete. Throws a ConnectException
            // if any of the requests fail
            $results = Utils::unwrap($promises);
            // Wait for the requests to complete, even if some of them fail
            $results = Utils::settle($promises)->wait();
        } catch (Exception $exception) {
            $this->throwException($exception);
        }
        // You can access each result using the key provided to the unwrap function.
        return \array_map(function (array $result) {
            return new ResponseWrapper($result['value']);
        }, $results);
    }
    /**
     * Try to increase the limit of the truncated response,
     * which is 120 chars by default.
     *
     * @see https://github.com/laravel/framework/discussions/47773
     */
    protected function maybeReplaceException(Exception $exception) : Exception
    {
        if (!$exception instanceof RequestException) {
            return $exception;
        }
        return $this->createRequestException($exception->getRequest(), $exception->getResponse(), $exception->getPrevious(), $exception->getHandlerContext());
    }
    /**
     * @throws GuzzleHTTPRequestException
     */
    protected function throwException(Exception $exception) : void
    {
        $exception = $this->maybeReplaceException($exception);
        throw new GuzzleHTTPRequestException($exception->getMessage(), 0, $exception);
    }
    /**
     * @param mixed[] $handlerContext
     */
    public function createRequestException(RequestInterface $request, ?UpstreamResponseInterface $response = null, ?Throwable $previous = null, array $handlerContext = []) : RequestException
    {
        return RequestException::create($request, $response instanceof ResponseInterface ? $response->getUpstreamResponse() : $response, $previous, $handlerContext, new BodySummarizer(1200));
    }
    public function createRequest(RequestInput $requestInput) : RequestInterface
    {
        return new Request($requestInput->method, $requestInput->url);
    }
}
