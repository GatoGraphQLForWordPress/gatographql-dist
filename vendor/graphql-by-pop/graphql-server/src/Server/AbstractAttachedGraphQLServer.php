<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\Server;

use GraphQLByPoP\GraphQLServer\Server\AbstractGraphQLServer;
use PoP\ComponentModel\App;
use PoP\ComponentModel\ExtendedSpec\Execution\ExecutableDocument;
use PoP\Root\AppThreadInterface;
use PoP\Root\HttpFoundation\Response;
/** @internal */
abstract class AbstractAttachedGraphQLServer extends AbstractGraphQLServer
{
    /**
     * @var int|null
     */
    protected $schemaConfigurationID;
    /**
     * @var \PoP\Root\AppThreadInterface
     */
    private $appThread;
    /**
     * Initialize the App with a new AppThread
     */
    public function __construct(?int $schemaConfigurationID)
    {
        $this->schemaConfigurationID = $schemaConfigurationID;
        /**
         * Steps:
         *
         * 1. Keep the current AppThread
         * 2. Initialize the App, retrieve the new AppThread
         * 3. Restore the current AppThread
         */
        $currentAppThread = App::getAppThread();
        $this->appThread = $this->initializeApp();
        App::setAppThread($currentAppThread);
    }
    protected abstract function initializeApp() : AppThreadInterface;
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
        /**
         * Keep the current AppThread, switch to the GraphQLServer's
         * one, resolve the query, and then restore the current AppThread.
         */
        $currentAppThread = App::getAppThread();
        App::setAppThread($this->appThread);
        /**
         * Because an "internal" request may be triggered
         * while resolving another "internal" request,
         * backup and then restore the App's state.
         */
        $appStateManager = App::getAppStateManager();
        $appState = $appStateManager->getAppState();
        $response = parent::execute($queryOrExecutableDocument, $variables, $operationName);
        // Restore the App's state
        $appStateManager->setAppState($appState);
        // Restore the original AppThread
        App::setAppThread($currentAppThread);
        return $response;
    }
}
