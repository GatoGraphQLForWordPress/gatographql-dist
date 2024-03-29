<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\EndpointExecuters;

use GatoGraphQL\GatoGraphQL\Constants\RequestParams;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\ClientFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\Services\Clients\CustomEndpointVoyagerClient;
use GatoGraphQL\GatoGraphQL\Services\EndpointAnnotators\ClientEndpointAnnotatorInterface;
use GatoGraphQL\GatoGraphQL\Services\EndpointAnnotators\VoyagerClientEndpointAnnotator;
use GraphQLByPoP\GraphQLClientsForWP\Clients\AbstractClient;

class VoyagerClientEndpointExecuter extends AbstractClientEndpointExecuter implements EndpointExecuterServiceTagInterface
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\Clients\CustomEndpointVoyagerClient|null
     */
    private $customEndpointVoyagerClient;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\EndpointAnnotators\VoyagerClientEndpointAnnotator|null
     */
    private $voyagerClientEndpointAnnotator;

    final public function setCustomEndpointVoyagerClient(CustomEndpointVoyagerClient $customEndpointVoyagerClient): void
    {
        $this->customEndpointVoyagerClient = $customEndpointVoyagerClient;
    }
    final protected function getCustomEndpointVoyagerClient(): CustomEndpointVoyagerClient
    {
        if ($this->customEndpointVoyagerClient === null) {
            /** @var CustomEndpointVoyagerClient */
            $customEndpointVoyagerClient = $this->instanceManager->getInstance(CustomEndpointVoyagerClient::class);
            $this->customEndpointVoyagerClient = $customEndpointVoyagerClient;
        }
        return $this->customEndpointVoyagerClient;
    }
    final public function setVoyagerClientEndpointAnnotator(VoyagerClientEndpointAnnotator $voyagerClientEndpointAnnotator): void
    {
        $this->voyagerClientEndpointAnnotator = $voyagerClientEndpointAnnotator;
    }
    final protected function getVoyagerClientEndpointAnnotator(): VoyagerClientEndpointAnnotator
    {
        if ($this->voyagerClientEndpointAnnotator === null) {
            /** @var VoyagerClientEndpointAnnotator */
            $voyagerClientEndpointAnnotator = $this->instanceManager->getInstance(VoyagerClientEndpointAnnotator::class);
            $this->voyagerClientEndpointAnnotator = $voyagerClientEndpointAnnotator;
        }
        return $this->voyagerClientEndpointAnnotator;
    }

    public function getEnablingModule(): ?string
    {
        return ClientFunctionalityModuleResolver::INTERACTIVE_SCHEMA_FOR_CUSTOM_ENDPOINTS;
    }

    protected function getView(): string
    {
        return RequestParams::VIEW_SCHEMA;
    }

    protected function getClient(): AbstractClient
    {
        return $this->getCustomEndpointVoyagerClient();
    }

    protected function getClientEndpointAnnotator(): ClientEndpointAnnotatorInterface
    {
        return $this->getVoyagerClientEndpointAnnotator();
    }
}
