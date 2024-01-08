<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\EndpointAnnotators;

use WP_Post;

interface ClientEndpointAnnotatorInterface extends EndpointAnnotatorInterface
{
    /**
     * @param \WP_Post|int $postOrID
     */
    public function isClientEnabled($postOrID): bool;
}
