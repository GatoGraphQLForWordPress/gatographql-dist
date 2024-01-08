<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\Blocks;

use GatoGraphQL\GatoGraphQL\Constants\BlockAttributeNames;
use GatoGraphQL\GatoGraphQL\StaticHelpers\BehaviorHelpers;
use PoPSchema\SchemaCommons\Constants\Behaviors;

trait AllowAccessToEntriesBlockTrait
{
    /**
     * Pass localized data to the block
     *
     * @return array<string,mixed>
     */
    protected function getDefaultBehaviorLocalizedData(): array
    {
        return [
            'defaultBehavior' => $this->getDefaultBehavior(),
        ];
    }

    protected function getDefaultBehavior(): string
    {
        $useRestrictiveDefaults = BehaviorHelpers::areRestrictiveDefaultsEnabled();
        return $useRestrictiveDefaults ? Behaviors::ALLOW : Behaviors::DENY;
    }

    /**
     * @param array<string,mixed> $attributes
     */
    protected function renderAllowAccessToEntriesBlock(array $attributes): string
    {
        $placeholder = '<p><strong>%s</strong></p>%s';
        $entries = $attributes[BlockAttributeNames::ENTRIES] ?? [];
        $behavior = $attributes[BlockAttributeNames::BEHAVIOR] ?? $this->getDefaultBehavior();
        switch ($behavior) {
            case Behaviors::ALLOW:
                return sprintf('✅ %s', $this->__('Allow access', 'gatographql'));
            case Behaviors::DENY:
                return sprintf('❌ %s', $this->__('Deny access', 'gatographql'));
            default:
                return $behavior;
        }
    }

    abstract protected function getRenderBlockLabel(): string;
}
