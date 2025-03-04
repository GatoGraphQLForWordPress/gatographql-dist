<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Settings;

use GatoGraphQL\GatoGraphQL\Facades\Settings\OptionNamespacerFacade;

use function delete_option;
use function get_option;
use function update_option;

class TimestampSettingsManager implements TimestampSettingsManagerInterface
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface|null
     */
    private $optionNamespacer;

    final protected function getOptionNamespacer(): OptionNamespacerInterface
    {
        return $this->optionNamespacer = $this->optionNamespacer ?? OptionNamespacerFacade::getInstance();
    }

    public function getTimestamp(string $name, ?string $defaultValue = null): ?string
    {
        /** @var array<string,string> */
        $timestamps = get_option($this->namespaceOption(Options::TIMESTAMPS), []);
        if (!array_key_exists($name, $timestamps)) {
            return $defaultValue;
        }
        return $timestamps[$name];
    }

    protected function namespaceOption(string $option): string
    {
        return $this->getOptionNamespacer()->namespaceOption($option);
    }

    public function storeTimestamp(string $name, string $timestamp): void
    {
        $this->storeTimestamps([$name => $timestamp]);
    }

    /**
     * @param array<string,string> $nameTimestamps Key: name, Value: timestamp
     */
    public function storeTimestamps(array $nameTimestamps): void
    {
        $option = $this->namespaceOption(Options::TIMESTAMPS);

        /**
         * Get the current timestamps from the DB
         * @var array<string,string>
         */
        $timestamps = get_option($option, []);

        /**
         * Override with the provided values
         */
        $timestamps = array_merge(
            $timestamps,
            $nameTimestamps
        );
        update_option($option, $timestamps);
    }

    /**
     * @param string[] $names
     */
    public function removeTimestamps(array $names): void
    {
        $option = $this->namespaceOption(Options::TIMESTAMPS);

        /**
         * Remove only the provided keys
         *
         * @var array<string,string>
         */
        $timestamps = get_option($option, []);
        foreach ($names as $name) {
            unset($timestamps[$name]);
        }

        /**
         * If there were no other keys, can safely delete the option
         */
        if ($timestamps === []) {
            delete_option($option);
            return;
        }

        update_option($option, $timestamps);
    }
}
