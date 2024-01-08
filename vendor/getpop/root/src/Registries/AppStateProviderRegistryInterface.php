<?php

declare (strict_types=1);
namespace PoP\Root\Registries;

use PoP\Root\State\AppStateProviderInterface;
/** @internal */
interface AppStateProviderRegistryInterface
{
    public function addAppStateProvider(AppStateProviderInterface $appStateProvider) : void;
    /**
     * @return AppStateProviderInterface[]
     */
    public function getAppStateProviders() : array;
    /**
     * @return AppStateProviderInterface[]
     */
    public function getEnabledAppStateProviders() : array;
}
