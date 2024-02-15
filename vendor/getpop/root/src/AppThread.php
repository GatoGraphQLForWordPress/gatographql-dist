<?php

declare (strict_types=1);
namespace PoP\Root;

use PoP\Root\Container\ContainerBuilderFactory;
use PoP\Root\Container\ContainerInterface;
use PoP\Root\Container\SystemContainerBuilderFactory;
use PoP\Root\Exception\ComponentNotExistsException;
use PoP\Root\Helpers\AppThreadHelpers;
use PoP\Root\HttpFoundation\Request;
use PoP\Root\HttpFoundation\Response;
use PoP\Root\Module\ModuleInterface;
use PoP\Root\StateManagers\AppStateManager;
use PoP\Root\StateManagers\AppStateManagerInterface;
use PoP\Root\StateManagers\HookManager;
use PoP\Root\StateManagers\HookManagerInterface;
use PoP\Root\StateManagers\ModuleManager;
use PoP\Root\StateManagers\ModuleManagerInterface;
use PrefixedByPoP\Symfony\Component\HttpFoundation\Exception\BadRequestException;
/**
 * Single class hosting all the top-level instances
 * to run the application. Only a single AppThread
 * will be active at a single time, and its state
 * will be accessed/modified by the whole application.
 * Access the current AppThread via the corresponding
 * methods in the `App` facade class.
 *
 * It keeps all state in the application stored and
 * accessible in a single place, so that regenerating
 * this class provides a new state.
 *
 * Needed for PHPUnit.
 * @internal
 */
class AppThread implements \PoP\Root\AppThreadInterface
{
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var array<string, mixed>
     */
    private $context = [];
    /**
     * @var \PoP\Root\AppLoaderInterface
     */
    protected $appLoader;
    /**
     * @var \PoP\Root\StateManagers\HookManagerInterface
     */
    protected $hookManager;
    /**
     * @var \PoP\Root\HttpFoundation\Request
     */
    protected $request;
    /**
     * @var \PoP\Root\HttpFoundation\Response
     */
    protected $response;
    /**
     * @var \PoP\Root\Container\ContainerBuilderFactory
     */
    protected $containerBuilderFactory;
    /**
     * @var \PoP\Root\Container\SystemContainerBuilderFactory
     */
    protected $systemContainerBuilderFactory;
    /**
     * @var \PoP\Root\StateManagers\ModuleManagerInterface
     */
    protected $moduleManager;
    /**
     * @var \PoP\Root\StateManagers\AppStateManagerInterface
     */
    protected $appStateManager;
    /** @var array<class-string<ModuleInterface>> */
    protected $moduleClassesToInitialize = [];
    /**
     * @var bool
     */
    protected $isHTTPRequest;
    /**
     * @var string|null
     */
    protected $uniqueID;
    /**
     * @param array<string,mixed> $context
     */
    public function __construct(?string $name = null, array $context = [])
    {
        $this->name = $name;
        $this->context = $context;
    }
    /**
     * This function must be invoked at the very beginning,
     * to initialize the instance to run the application.
     *
     * Either inject the desired instance, or have the Root
     * provide the default one.
     */
    public function initialize(?\PoP\Root\AppLoaderInterface $appLoader = null, ?HookManagerInterface $hookManager = null, ?Request $request = null, ?ContainerBuilderFactory $containerBuilderFactory = null, ?SystemContainerBuilderFactory $systemContainerBuilderFactory = null, ?ModuleManagerInterface $moduleManager = null, ?AppStateManagerInterface $appStateManager = null) : void
    {
        $this->appLoader = $appLoader ?? $this->createAppLoader();
        $this->hookManager = $hookManager ?? $this->createHookManager();
        $this->request = $request ?? $this->createRequest();
        $this->containerBuilderFactory = $containerBuilderFactory ?? $this->createContainerBuilderFactory();
        $this->systemContainerBuilderFactory = $systemContainerBuilderFactory ?? $this->createSystemContainerBuilderFactory();
        $this->moduleManager = $moduleManager ?? $this->createComponentManager();
        $this->appStateManager = $appStateManager ?? $this->createAppStateManager();
        $this->setResponse($this->createResponse());
        // Inject the Components slated for initialization
        $this->appLoader->addModuleClassesToInitialize($this->moduleClassesToInitialize);
        $this->moduleClassesToInitialize = [];
        /**
         * Indicate if this App is invoked via an HTTP request.
         * If not, it may be directly invoked as a PHP component,
         * or from a PHPUnit test.
         */
        $this->isHTTPRequest = $this->server('REQUEST_METHOD') !== null;
    }
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * Store properties for identifying across different
     * INTERNAL GraphQL servers, by storing the
     * persisted query for each in the context.
     *
     * @return array<string,mixed>
     */
    public function getContext() : array
    {
        return $this->context;
    }
    /**
     * Combination of the Name and Context
     * to uniquely identify the AppThread
     */
    public function getUniqueID() : string
    {
        if ($this->uniqueID === null) {
            $this->uniqueID = AppThreadHelpers::getUniqueID($this->getName(), $this->getContext());
        }
        return $this->uniqueID;
    }
    protected function createAppLoader() : \PoP\Root\AppLoaderInterface
    {
        return new \PoP\Root\AppLoader();
    }
    protected function createHookManager() : HookManagerInterface
    {
        return new HookManager();
    }
    protected function createRequest() : Request
    {
        return Request::createFromGlobals();
    }
    /**
     * @see https://symfony.com/doc/current/components/http_foundation.html#response
     */
    protected function createResponse() : Response
    {
        return new Response();
    }
    protected function createContainerBuilderFactory() : ContainerBuilderFactory
    {
        return new ContainerBuilderFactory();
    }
    protected function createSystemContainerBuilderFactory() : SystemContainerBuilderFactory
    {
        return new SystemContainerBuilderFactory();
    }
    protected function createComponentManager() : ModuleManagerInterface
    {
        return new ModuleManager();
    }
    protected function createAppStateManager() : AppStateManagerInterface
    {
        return new AppStateManager();
    }
    public function setResponse(Response $response) : void
    {
        $this->response = $response;
    }
    public function getAppLoader() : \PoP\Root\AppLoaderInterface
    {
        return $this->appLoader;
    }
    public function getHookManager() : HookManagerInterface
    {
        return $this->hookManager;
    }
    public function getRequest() : Request
    {
        return $this->request;
    }
    public function getResponse() : Response
    {
        return $this->response;
    }
    public function getContainerBuilderFactory() : ContainerBuilderFactory
    {
        return $this->containerBuilderFactory;
    }
    public function getSystemContainerBuilderFactory() : SystemContainerBuilderFactory
    {
        return $this->systemContainerBuilderFactory;
    }
    public function getModuleManager() : ModuleManagerInterface
    {
        return $this->moduleManager;
    }
    public function getAppStateManager() : AppStateManagerInterface
    {
        return $this->appStateManager;
    }
    public function isHTTPRequest() : bool
    {
        return $this->isHTTPRequest;
    }
    /**
     * Store Module classes to be initialized, and
     * inject them into the AppLoader when this is initialized.
     *
     * @param array<class-string<ModuleInterface>> $moduleClasses List of `Module` class to initialize
     */
    public function stockAndInitializeModuleClasses(array $moduleClasses) : void
    {
        $this->moduleClassesToInitialize = \array_merge($this->moduleClassesToInitialize, $moduleClasses);
    }
    /**
     * Shortcut function.
     */
    public final function getContainer() : ContainerInterface
    {
        return $this->containerBuilderFactory->getInstance();
    }
    /**
     * Shortcut function.
     */
    public final function getSystemContainer() : ContainerInterface
    {
        return $this->systemContainerBuilderFactory->getInstance();
    }
    /**
     * Shortcut function.
     *
     * @phpstan-param class-string<ModuleInterface> $moduleClass
     * @throws ComponentNotExistsException
     */
    public final function getModule(string $moduleClass) : ModuleInterface
    {
        return $this->moduleManager->getModule($moduleClass);
    }
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public final function getState($keyOrPath)
    {
        $appStateManager = $this->appStateManager;
        if (\is_array($keyOrPath)) {
            /** @var string[] */
            $path = $keyOrPath;
            return $appStateManager->getUnder($path);
        }
        /** @var string */
        $key = $keyOrPath;
        return $appStateManager->get($key);
    }
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public final function hasState($keyOrPath)
    {
        $appStateManager = $this->appStateManager;
        if (\is_array($keyOrPath)) {
            /** @var string[] */
            $path = $keyOrPath;
            return $appStateManager->hasUnder($path);
        }
        /** @var string */
        $key = $keyOrPath;
        return $appStateManager->has($key);
    }
    /**
     * Shortcut function.
     */
    public final function addFilter(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void
    {
        $this->hookManager->addFilter($tag, $function_to_add, $priority, $accepted_args);
    }
    /**
     * Shortcut function.
     */
    public final function removeFilter(string $tag, callable $function_to_remove, int $priority = 10) : bool
    {
        return $this->hookManager->removeFilter($tag, $function_to_remove, $priority);
    }
    /**
     * Shortcut function.
     * @param mixed $value
     * @param mixed ...$args
     * @return mixed
     */
    public final function applyFilters(string $tag, $value, ...$args)
    {
        return $this->hookManager->applyFilters($tag, $value, ...$args);
    }
    /**
     * Shortcut function.
     */
    public final function addAction(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void
    {
        $this->hookManager->addAction($tag, $function_to_add, $priority, $accepted_args);
    }
    /**
     * Shortcut function.
     */
    public final function removeAction(string $tag, callable $function_to_remove, int $priority = 10) : bool
    {
        return $this->hookManager->removeAction($tag, $function_to_remove, $priority);
    }
    /**
     * Shortcut function.
     * @param mixed ...$args
     */
    public final function doAction(string $tag, ...$args) : void
    {
        $this->hookManager->doAction($tag, ...$args);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_POST[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public final function request(string $key, $default = null)
    {
        /**
         * `get` doesn't support arrays, then use ->all for that case
         *
         * @see https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
         */
        try {
            return $this->request->request->get($key, $default);
        } catch (BadRequestException $exception) {
            return $this->request->request->all($key);
        }
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_GET[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public final function query(string $key, $default = null)
    {
        /**
         * `get` doesn't support arrays, then use ->all for that case
         *
         * @see https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
         */
        try {
            return $this->request->query->get($key, $default);
        } catch (BadRequestException $exception) {
            return $this->request->query->all($key);
        }
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_COOKIES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public final function cookies(string $key, $default = null)
    {
        return $this->request->cookies->get($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_FILES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public final function files(string $key, $default = null)
    {
        return $this->request->files->get($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_SERVER[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public final function server(string $key, $default = null)
    {
        return $this->request->server->get($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Mostly equivalent to a subset of $_SERVER
     * @param mixed $default
     * @return mixed
     */
    public final function headers(string $key, $default = null)
    {
        return $this->request->headers->get($key, $default);
    }
}
