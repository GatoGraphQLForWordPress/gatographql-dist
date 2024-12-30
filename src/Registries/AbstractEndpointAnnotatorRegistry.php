<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Registries;

use GatoGraphQL\GatoGraphQL\Services\EndpointAnnotators\EndpointAnnotatorInterface;
use PoP\Root\Services\ActivableServiceInterface;

abstract class AbstractEndpointAnnotatorRegistry implements EndpointAnnotatorRegistryInterface
{
    /**
     * @var EndpointAnnotatorInterface[]
     */
    protected $endpointAnnotators = [];

    public function addEndpointAnnotator(EndpointAnnotatorInterface $endpointAnnotator): void
    {
        $this->endpointAnnotators[] = $endpointAnnotator;
    }
    /**
     * @return EndpointAnnotatorInterface[]
     */
    public function getEndpointAnnotators(): array
    {
        return $this->endpointAnnotators;
    }
    /**
     * @return EndpointAnnotatorInterface[]
     */
    public function getEnabledEndpointAnnotators(): array
    {
        return array_values(array_filter(
            $this->getEndpointAnnotators(),
            function (ActivableServiceInterface $service) {
                return $service->isServiceEnabled();
            }
        ));
    }
}
