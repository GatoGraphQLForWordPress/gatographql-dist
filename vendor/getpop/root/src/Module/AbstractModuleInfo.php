<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
abstract class AbstractModuleInfo implements \PoP\Root\Module\ModuleInfoInterface
{
    /**
     * @var array<string,mixed>
     */
    protected array $values = [];
    public final function __construct(protected \PoP\Root\Module\ModuleInterface $module)
    {
        $this->initialize();
    }
    protected abstract function initialize() : void;
    public function get(string $key) : mixed
    {
        return $this->values[$key] ?? null;
    }
}
