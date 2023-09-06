<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\PluginSkeleton;

interface PluginInfoInterface
{
    /**
     * @return mixed
     */
    public function get(string $key);
}
