<?php

declare (strict_types=1);
namespace PoP\Root\StateManagers;

use PoP\Root\Exception\AppStateNotExistsException;
/** @internal */
interface AppStateManagerInterface
{
    /**
     * Called by the AppLoader to initialize the state.
     *
     * Initialize application state
     *
     * @param array<string,mixed> $initialAppState
     */
    public function initializeAppState(array $initialAppState) : void;
    /**
     * Called by the AppLoader to "boot" the state.
     *
     * Execute application state
     */
    public function executeAppState() : void;
    /**
     * Called by the AttachedGraphQLServer to backup the
     * state before executing a GraphQL request
     *
     * @return array<string,mixed>
     * @internal
     */
    public function getAppState() : array;
    /**
     * Called by the AttachedGraphQLServer to restore the
     * state after executing a GraphQL request
     *
     * @param array<string,mixed> $appState
     * @internal
     */
    public function setAppState(array $appState) : void;
    /**
     * @return array<string,mixed>
     */
    public function all() : array;
    /**
     * To be called by Engine. Use with care!
     * @param mixed $value
     */
    public function override(string $key, $value) : void;
    /**
     * @throws AppStateNotExistsException If there is no state under the provided key
     * @return mixed
     */
    public function get(string $key);
    /**
     * @throws AppStateNotExistsException If there is no state under the provided path
     * @param string[] $path
     * @return mixed
     */
    public function getUnder(array $path);
    public function has(string $key) : bool;
    /**
     * @param string[] $path
     */
    public function hasUnder(array $path) : bool;
}
