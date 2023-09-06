<?php

declare (strict_types=1);
namespace PoP\Root\Module;

abstract class AbstractModuleInfo implements \PoP\Root\Module\ModuleInfoInterface
{
    /**
     * @var \PoP\Root\Module\ModuleInterface
     */
    protected $module;
    /**
     * @var array<string,mixed>
     */
    protected $values = [];
    public final function __construct(\PoP\Root\Module\ModuleInterface $module)
    {
        $this->module = $module;
        $this->initialize();
    }
    protected abstract function initialize() : void;
    /**
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->values[$key] ?? null;
    }
}
