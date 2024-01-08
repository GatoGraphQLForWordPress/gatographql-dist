<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\PluginSkeleton;

abstract class AbstractPluginInfo implements PluginInfoInterface
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\PluginSkeleton\PluginInterface
     */
    protected $plugin;
    /**
     * @var array<string,mixed>
     */
    protected $values = [];

    final public function __construct(
        PluginInterface $plugin
    ) {
        $this->plugin = $plugin;
        $this->initialize();
    }

    abstract protected function initialize(): void;

    /**
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->values[$key] ?? null;
    }
}
