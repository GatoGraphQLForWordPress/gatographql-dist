<?php

declare (strict_types=1);
namespace PoP\Root;

use PoP\Root\Container\ContainerBuilderFactory;
use PoP\Root\Container\ContainerInterface;
use PoP\Root\Container\SystemContainerBuilderFactory;
use PoP\Root\Exception\ComponentNotExistsException;
use PoP\Root\HttpFoundation\Request;
use PoP\Root\HttpFoundation\Response;
use PoP\Root\Module\ModuleInterface;
use PoP\Root\StateManagers\AppStateManagerInterface;
use PoP\Root\StateManagers\HookManagerInterface;
use PoP\Root\StateManagers\ModuleManagerInterface;
/**
 * Facade to the current AppThread object that hosts
 * all the top-level instances to run the application.
 *
 * This interface contains all the methods from the
 * AppThreadInterface (to provide access to them)
 * but as static.
 * @internal
 */
class App implements \PoP\Root\AppInterface
{
    /**
     * @var bool
     */
    protected static $initialized = \false;
    /**
     * @var \PoP\Root\AppThreadInterface
     */
    protected static $appThread;
    /**
     * This function must be invoked at the very beginning,
     * to initialize the instance to run the application.
     *
     * Also it allows to set a new AppThread instance at
     * any time, to initiate a new context.
     */
    public static function setAppThread(\PoP\Root\AppThreadInterface $appThread) : void
    {
        self::$appThread = $appThread;
    }
    /**
     * Allow to get the current AppThread, to store
     * (and put back later) when initiating a new context.
     */
    public static function getAppThread() : \PoP\Root\AppThreadInterface
    {
        return self::$appThread;
    }
    public static function isInitialized() : bool
    {
        return self::$initialized;
    }
    /**
     * This function must be invoked right after calling
     * `setAppThread` with the new AppThread instance,
     * to initialize it to run the application.
     *
     * Either inject the desired instance, or have the Root
     * provide the default one.
     *
     * It creates a new AppThread and sets it as the current
     * object hosting all state in the application.
     */
    public static function initialize(?\PoP\Root\AppLoaderInterface $appLoader = null, ?HookManagerInterface $hookManager = null, ?Request $request = null, ?ContainerBuilderFactory $containerBuilderFactory = null, ?SystemContainerBuilderFactory $systemContainerBuilderFactory = null, ?ModuleManagerInterface $moduleManager = null, ?AppStateManagerInterface $appStateManager = null) : void
    {
        self::$initialized = \true;
        self::$appThread->initialize($appLoader, $hookManager, $request, $containerBuilderFactory, $systemContainerBuilderFactory, $moduleManager, $appStateManager);
    }
    public static function setResponse(Response $response) : void
    {
        self::$appThread->setResponse($response);
    }
    public static function getAppLoader() : \PoP\Root\AppLoaderInterface
    {
        return self::$appThread->getAppLoader();
    }
    public static function getHookManager() : HookManagerInterface
    {
        return self::$appThread->getHookManager();
    }
    public static function getRequest() : Request
    {
        return self::$appThread->getRequest();
    }
    public static function getResponse() : Response
    {
        return self::$appThread->getResponse();
    }
    public static function getContainerBuilderFactory() : ContainerBuilderFactory
    {
        return self::$appThread->getContainerBuilderFactory();
    }
    public static function getSystemContainerBuilderFactory() : SystemContainerBuilderFactory
    {
        return self::$appThread->getSystemContainerBuilderFactory();
    }
    public static function getModuleManager() : ModuleManagerInterface
    {
        return self::$appThread->getModuleManager();
    }
    public static function getAppStateManager() : AppStateManagerInterface
    {
        return self::$appThread->getAppStateManager();
    }
    public static function isHTTPRequest() : bool
    {
        return self::$appThread->isHTTPRequest();
    }
    /**
     * Store Module classes to be initialized, and
     * inject them into the AppLoader when this is initialized.
     *
     * @param array<class-string<ModuleInterface>> $moduleClasses List of `Module` class to initialize
     */
    public static function stockAndInitializeModuleClasses(array $moduleClasses) : void
    {
        self::$appThread->stockAndInitializeModuleClasses($moduleClasses);
    }
    /**
     * Shortcut function.
     */
    public static final function getContainer() : ContainerInterface
    {
        return self::$appThread->getContainer();
    }
    /**
     * Shortcut function.
     */
    public static final function getSystemContainer() : ContainerInterface
    {
        return self::$appThread->getSystemContainer();
    }
    /**
     * Shortcut function.
     *
     * @phpstan-param class-string<ModuleInterface> $moduleClass
     * @throws ComponentNotExistsException
     */
    public static final function getModule(string $moduleClass) : ModuleInterface
    {
        return self::$appThread->getModule($moduleClass);
    }
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public static final function getState($keyOrPath)
    {
        return self::$appThread->getState($keyOrPath);
    }
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public static final function hasState($keyOrPath)
    {
        return self::$appThread->hasState($keyOrPath);
    }
    /**
     * Shortcut function.
     */
    public static final function addFilter(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void
    {
        self::$appThread->addFilter($tag, $function_to_add, $priority, $accepted_args);
    }
    /**
     * Shortcut function.
     */
    public static final function removeFilter(string $tag, callable $function_to_remove, int $priority = 10) : bool
    {
        return self::$appThread->removeFilter($tag, $function_to_remove, $priority);
    }
    /**
     * Shortcut function.
     * @param mixed $value
     * @param mixed ...$args
     * @return mixed
     */
    public static final function applyFilters(string $tag, $value, ...$args)
    {
        return self::$appThread->applyFilters($tag, $value, ...$args);
    }
    /**
     * Shortcut function.
     */
    public static final function addAction(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void
    {
        self::$appThread->addAction($tag, $function_to_add, $priority, $accepted_args);
    }
    /**
     * Shortcut function.
     */
    public static final function removeAction(string $tag, callable $function_to_remove, int $priority = 10) : bool
    {
        return self::$appThread->removeAction($tag, $function_to_remove, $priority);
    }
    /**
     * Shortcut function.
     * @param mixed ...$args
     */
    public static final function doAction(string $tag, ...$args) : void
    {
        self::$appThread->doAction($tag, ...$args);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_POST[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static final function request(string $key, $default = null)
    {
        return self::$appThread->request($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_GET[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static final function query(string $key, $default = null)
    {
        return self::$appThread->query($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_COOKIES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static final function cookies(string $key, $default = null)
    {
        return self::$appThread->cookies($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_FILES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static final function files(string $key, $default = null)
    {
        return self::$appThread->files($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Equivalent of $_SERVER[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static final function server(string $key, $default = null)
    {
        return self::$appThread->server($key, $default);
    }
    /**
     * Shortcut function.
     *
     * Mostly equivalent to a subset of $_SERVER
     * @param mixed $default
     * @return mixed
     */
    public static final function headers(string $key, $default = null)
    {
        return self::$appThread->headers($key, $default);
    }
}
