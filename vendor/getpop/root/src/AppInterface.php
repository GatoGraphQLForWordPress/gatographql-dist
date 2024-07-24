<?php

declare (strict_types=1);
namespace PoP\Root;

use PoP\Root\Module\ModuleInterface;
use PoP\Root\Container\ContainerBuilderFactory;
use PoP\Root\Container\ContainerInterface;
use PoP\Root\Container\SystemContainerBuilderFactory;
use PoP\Root\Exception\ComponentNotExistsException;
use PoP\Root\HttpFoundation\Request;
use PoP\Root\HttpFoundation\Response;
use PoP\Root\StateManagers\AppStateManagerInterface;
use PoP\Root\StateManagers\ModuleManagerInterface;
use PoP\Root\StateManagers\HookManagerInterface;
/**
 * Facade to the current AppThread object that hosts
 * all the top-level instances to run the application.
 *
 * This interface contains all the methods from the
 * AppThreadInterface (to provide access to them)
 * but as static.
 * @internal
 */
interface AppInterface
{
    public static function isInitialized() : bool;
    /**
     * This function must be invoked at the very beginning,
     * to initialize the instance to run the application.
     *
     * Also it allows to set a new AppThread instance at
     * any time, to initiate a new context.
     */
    public static function setAppThread(\PoP\Root\AppThreadInterface $appThread) : void;
    /**
     * Allow to get the current AppThread, to store
     * (and put back later) when initiating a new context.
     */
    public static function getAppThread() : \PoP\Root\AppThreadInterface;
    /**
     * All methods below are facade accessor methods to
     * the AppThread class.
     */
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
    public static function initialize(?\PoP\Root\AppLoaderInterface $appLoader = null, ?HookManagerInterface $hookManager = null, ?Request $request = null, ?ContainerBuilderFactory $containerBuilderFactory = null, ?SystemContainerBuilderFactory $systemContainerBuilderFactory = null, ?ModuleManagerInterface $moduleManager = null, ?AppStateManagerInterface $appStateManager = null) : void;
    public static function setResponse(Response $response) : void;
    public static function getAppLoader() : \PoP\Root\AppLoaderInterface;
    public static function getHookManager() : HookManagerInterface;
    public static function getRequest() : Request;
    public static function getResponse() : Response;
    public static function getContainerBuilderFactory() : ContainerBuilderFactory;
    public static function getSystemContainerBuilderFactory() : SystemContainerBuilderFactory;
    public static function getModuleManager() : ModuleManagerInterface;
    public static function getAppStateManager() : AppStateManagerInterface;
    public static function isHTTPRequest() : bool;
    /**
     * Store Module classes to be initialized, and
     * inject them into the AppLoader when this is initialized.
     *
     * @param array<class-string<ModuleInterface>> $moduleClasses List of `Module` class to initialize
     */
    public static function stockAndInitializeModuleClasses(array $moduleClasses) : void;
    /**
     * Shortcut function.
     */
    public static function getContainer() : ContainerInterface;
    /**
     * Shortcut function.
     */
    public static function getSystemContainer() : ContainerInterface;
    /**
     * Shortcut function.
     *
     * @phpstan-param class-string<ModuleInterface> $moduleClass
     * @throws ComponentNotExistsException
     */
    public static function getModule(string $moduleClass) : ModuleInterface;
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public static function getState($keyOrPath);
    /**
     * Shortcut function.
     * @param string|string[] $keyOrPath The property key, or a property path for array values
     * @return mixed
     */
    public static function hasState($keyOrPath);
    /**
     * Shortcut function.
     */
    public static function addFilter(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void;
    /**
     * Shortcut function.
     */
    public static function removeFilter(string $tag, callable $function_to_remove, int $priority = 10) : bool;
    /**
     * Shortcut function.
     * @param mixed $value
     * @param mixed ...$args
     * @return mixed
     */
    public static function applyFilters(string $tag, $value, ...$args);
    /**
     * Shortcut function.
     */
    public static function addAction(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1) : void;
    /**
     * Shortcut function.
     */
    public static function removeAction(string $tag, callable $function_to_remove, int $priority = 10) : bool;
    /**
     * Shortcut function.
     * @param mixed ...$args
     */
    public static function doAction(string $tag, ...$args) : void;
    /**
     * Shortcut function.
     *
     * Equivalent of $_POST[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static function request(string $key, $default = null);
    /**
     * Shortcut function.
     *
     * Equivalent of $_GET[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static function query(string $key, $default = null);
    /**
     * Shortcut function.
     *
     * Equivalent of $_COOKIES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static function cookies(string $key, $default = null);
    /**
     * Shortcut function.
     *
     * Equivalent of $_FILES[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static function files(string $key, $default = null);
    /**
     * Shortcut function.
     *
     * Equivalent of $_SERVER[$key] ?? $default
     * @param mixed $default
     * @return mixed
     */
    public static function server(string $key, $default = null);
    /**
     * Shortcut function.
     *
     * Mostly equivalent to a subset of $_SERVER
     * @param mixed $default
     * @return mixed
     */
    public static function headers(string $key, $default = null);
}
