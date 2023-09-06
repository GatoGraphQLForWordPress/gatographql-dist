<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\Server;

use PoPAPI\API\HelperServices\ApplicationStateFillerServiceInterface;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Engine\EngineInterface;
use PoP\ComponentModel\ExtendedSpec\Execution\ExecutableDocument;
use PoP\Root\Facades\Instances\InstanceManagerFacade;
use PoP\Root\HttpFoundation\Response;
use PoP\Root\Services\StandaloneServiceTrait;
abstract class AbstractGraphQLServer implements \GraphQLByPoP\GraphQLServer\Server\GraphQLServerInterface
{
    use StandaloneServiceTrait;
    /**
     * @var \PoPAPI\API\HelperServices\ApplicationStateFillerServiceInterface|null
     */
    private $applicationStateFillerService;
    /**
     * @var \PoP\ComponentModel\Engine\EngineInterface|null
     */
    private $engine;
    public final function setApplicationStateFillerService(ApplicationStateFillerServiceInterface $applicationStateFillerService) : void
    {
        $this->applicationStateFillerService = $applicationStateFillerService;
    }
    protected final function getApplicationStateFillerService() : ApplicationStateFillerServiceInterface
    {
        if ($this->applicationStateFillerService === null) {
            /** @var ApplicationStateFillerServiceInterface */
            $applicationStateFillerService = InstanceManagerFacade::getInstance()->getInstance(ApplicationStateFillerServiceInterface::class);
            $this->applicationStateFillerService = $applicationStateFillerService;
        }
        return $this->applicationStateFillerService;
    }
    public final function setEngine(EngineInterface $engine) : void
    {
        $this->engine = $engine;
    }
    protected final function getEngine() : EngineInterface
    {
        if ($this->engine === null) {
            /** @var EngineInterface */
            $engine = InstanceManagerFacade::getInstance()->getInstance(EngineInterface::class);
            $this->engine = $engine;
        }
        return $this->engine;
    }
    /**
     * The basic state for executing GraphQL queries is already set.
     * In addition, inject the actual GraphQL query and variables,
     * build the AST, and generate and print the data.
     *
     * @param array<string,mixed> $variables
     * @param string|\PoP\ComponentModel\ExtendedSpec\Execution\ExecutableDocument $queryOrExecutableDocument
     */
    public function execute($queryOrExecutableDocument, array $variables = [], ?string $operationName = null) : Response
    {
        // Keep the current response, to be restored later on
        $currentResponse = App::getResponse();
        // Set a new Response into the AppState
        App::setResponse(new Response());
        $this->getApplicationStateFillerService()->defineGraphQLQueryVarsInApplicationState($queryOrExecutableDocument, $variables, $operationName);
        /**
         * Create and stack a new Response object, to be
         * used during this processing
         */
        $this->getEngine()->generateDataAndPrepareResponse($this->areFeedbackAndTracingStoresAlreadyCreated());
        $response = App::getResponse();
        // Restore the previous Response
        App::setResponse($currentResponse);
        return $response;
    }
    protected abstract function areFeedbackAndTracingStoresAlreadyCreated() : bool;
}
