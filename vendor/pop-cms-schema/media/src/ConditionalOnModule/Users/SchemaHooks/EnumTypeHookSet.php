<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\ConditionalOnModule\Users\SchemaHooks;

use PoP\Root\App;
use PoP\ComponentModel\TypeResolvers\EnumType\EnumTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\EnumType\HookNames;
use PoP\Root\Hooks\AbstractHookSet;
use PoPCMSSchema\Media\ConditionalOnModule\Users\Constants\MediaItemOrderBy;
use PoPCMSSchema\Media\TypeResolvers\EnumType\MediaItemOrderByEnumTypeResolver;
/** @internal */
class EnumTypeHookSet extends AbstractHookSet
{
    protected function init() : void
    {
        App::addFilter(HookNames::ENUM_VALUES, \Closure::fromCallable([$this, 'getEnumValues']), 10, 2);
        App::addFilter(HookNames::ENUM_VALUE_DESCRIPTION, \Closure::fromCallable([$this, 'getEnumValueDescription']), 10, 3);
    }
    /**
     * @param string[] $enumValues
     * @return string[]
     */
    public function getEnumValues(array $enumValues, EnumTypeResolverInterface $enumTypeResolver) : array
    {
        if (!$enumTypeResolver instanceof MediaItemOrderByEnumTypeResolver) {
            return $enumValues;
        }
        return \array_merge($enumValues, [MediaItemOrderBy::AUTHOR]);
    }
    public function getEnumValueDescription(?string $enumValueDescription, EnumTypeResolverInterface $enumTypeResolver, string $enumValue) : ?string
    {
        if (!$enumTypeResolver instanceof MediaItemOrderByEnumTypeResolver) {
            return $enumValueDescription;
        }
        switch ($enumValue) {
            case MediaItemOrderBy::AUTHOR:
                return $this->__('Order by media item author', 'media');
            default:
                return $enumValueDescription;
        }
    }
}
