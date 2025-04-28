<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Settings;

interface TransientSettingsManagerInterface
{
    /**
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getTransient(string $name, $defaultValue = null);
    /**
     * @param mixed $transient
     */
    public function storeTransient(string $name, $transient): void;
    /**
     * @param array<string,mixed> $nameTransients Key: name, Value: transient data
     */
    public function storeTransients(array $nameTransients): void;
    /**
     * @param string[] $names
     */
    public function removeTransients(array $names): void;
}
