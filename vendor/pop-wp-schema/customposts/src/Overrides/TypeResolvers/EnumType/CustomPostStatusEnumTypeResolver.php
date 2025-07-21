<?php

declare(strict_types=1);

namespace PoPWPSchema\CustomPosts\Overrides\TypeResolvers\EnumType;

use PoPWPSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver as UpstreamCustomPostStatusEnumTypeResolver;

/**
 * Add the additional "WordPress"-specific statuses
 */
class CustomPostStatusEnumTypeResolver extends UpstreamCustomPostStatusEnumTypeResolver
{
    /**
     * @return string[]
     */
    public function getEnumValues(): array
    {
        return array_merge(parent::getEnumValues(), [CustomPostStatus::FUTURE, CustomPostStatus::PRIVATE, CustomPostStatus::INHERIT]);
    }

    public function getEnumValueDescription(string $enumValue): ?string
    {
        switch ($enumValue) {
            case CustomPostStatus::FUTURE:
                return $this->__('Future content', 'customposts');
            case CustomPostStatus::PRIVATE:
                return $this->__('Private content', 'customposts');
            case CustomPostStatus::INHERIT:
                return $this->__('Inherit content', 'customposts');
            default:
                return parent::getEnumValueDescription($enumValue);
        }
    }
}
