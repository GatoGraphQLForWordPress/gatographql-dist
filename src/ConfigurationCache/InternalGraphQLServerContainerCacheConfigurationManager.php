<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ConfigurationCache;

use GatoGraphQL\GatoGraphQL\StateManagers\AppThreadHelper;

class InternalGraphQLServerContainerCacheConfigurationManager extends ContainerCacheConfigurationManager
{
    /**
     * @var array<string, mixed>
     */
    private $pluginAppGraphQLServerContext;
    /**
     * @param array<string,mixed> $pluginAppGraphQLServerContext
     */
    public function __construct(array $pluginAppGraphQLServerContext)
    {
        $this->pluginAppGraphQLServerContext = $pluginAppGraphQLServerContext;
    }

    /**
     * The internal server is always private, and has the
     * same configuration as the default admin endpoint.
     */
    protected function getNamespaceSuffix(): string
    {
        $graphQLServerContextID = AppThreadHelper::getGraphQLServerContextUniqueID($this->pluginAppGraphQLServerContext);
        return 'internal_' . $graphQLServerContextID;
    }
}
