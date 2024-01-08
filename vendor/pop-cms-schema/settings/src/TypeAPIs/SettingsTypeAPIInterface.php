<?php

declare (strict_types=1);
namespace PoPCMSSchema\Settings\TypeAPIs;

use PoPCMSSchema\Settings\Exception\OptionNotAllowedException;
/** @internal */
interface SettingsTypeAPIInterface
{
    /**
     * @param array<string,mixed> $options
     * @throws OptionNotAllowedException When the option does not exist, or is not in the allowlist
     * @return mixed
     */
    public function getOption(string $name, array $options = []);
    public function validateIsOptionAllowed(string $key) : bool;
    /**
     * @return string[]
     */
    public function getAllowOrDenyOptionEntries() : array;
    public function getAllowOrDenyOptionBehavior() : string;
}
