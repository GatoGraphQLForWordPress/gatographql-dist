<?php

declare(strict_types=1);

namespace PoPWPSchema\CustomPosts\Overrides\TypeResolvers\EnumType;

use PoPWPSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver as UpstreamCustomPostStatusEnumTypeResolver;

/**
 * Add the "private" status
 */
class CustomPostStatusEnumTypeResolver extends UpstreamCustomPostStatusEnumTypeResolver
{
    /**
     * @return string[]
     */
    public function getEnumValues(): array
    {
        return array_merge(parent::getEnumValues(), [CustomPostStatus::PRIVATE]);
    }

    public function getEnumValueDescription(string $enumValue): ?string
    {
        switch ($enumValue) {
            case CustomPostStatus::PRIVATE:
                return $this->__('Private content', 'customposts');
            default:
                return parent::getEnumValueDescription($enumValue);
        }
    }
}
