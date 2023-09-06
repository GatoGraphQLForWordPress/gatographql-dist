<?php

declare (strict_types=1);
namespace PoPCMSSchema\Settings\TypeAPIs;

use PoP\Root\App;
use PoP\Root\Services\BasicServiceTrait;
use PoPCMSSchema\Settings\Module;
use PoPCMSSchema\Settings\ModuleConfiguration;
use PoPCMSSchema\Settings\Exception\OptionNotAllowedException;
use PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface;
abstract class AbstractSettingsTypeAPI implements \PoPCMSSchema\Settings\TypeAPIs\SettingsTypeAPIInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface|null
     */
    private $allowOrDenySettingsService;
    public final function setAllowOrDenySettingsService(AllowOrDenySettingsServiceInterface $allowOrDenySettingsService) : void
    {
        $this->allowOrDenySettingsService = $allowOrDenySettingsService;
    }
    protected final function getAllowOrDenySettingsService() : AllowOrDenySettingsServiceInterface
    {
        if ($this->allowOrDenySettingsService === null) {
            /** @var AllowOrDenySettingsServiceInterface */
            $allowOrDenySettingsService = $this->instanceManager->getInstance(AllowOrDenySettingsServiceInterface::class);
            $this->allowOrDenySettingsService = $allowOrDenySettingsService;
        }
        return $this->allowOrDenySettingsService;
    }
    /**
     * If the allow/denylist validation fails, and passing option "assert-is-option-allowed",
     * then throw an exception.
     *
     * @param array<string,mixed> $options
     * @throws OptionNotAllowedException When the option name is not in the allowlist. Enabled by passing option "assert-is-option-allowed"
     * @return mixed
     */
    public final function getOption(string $name, array $options = [])
    {
        if ($options['assert-is-option-allowed'] ?? null) {
            $this->assertIsOptionAllowed($name);
        }
        return $this->doGetOption($name);
    }
    /**
     * @return string[]
     */
    public function getAllowOrDenyOptionEntries() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getSettingsEntries();
    }
    public function getAllowOrDenyOptionBehavior() : string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getSettingsBehavior();
    }
    public final function validateIsOptionAllowed(string $name) : bool
    {
        return $this->getAllowOrDenySettingsService()->isEntryAllowed($name, $this->getAllowOrDenyOptionEntries(), $this->getAllowOrDenyOptionBehavior());
    }
    /**
     * If the allow/denylist validation fails, throw an exception.
     *
     * @throws OptionNotAllowedException
     */
    protected final function assertIsOptionAllowed(string $name) : void
    {
        if (!$this->validateIsOptionAllowed($name)) {
            throw new OptionNotAllowedException(\sprintf($this->__('There is no option with name \'%s\'', 'settings'), $name));
        }
    }
    /**
     * If the name is non-existent, return `null`.
     * Otherwise, return the value.
     * @return mixed
     */
    protected abstract function doGetOption(string $name);
}
