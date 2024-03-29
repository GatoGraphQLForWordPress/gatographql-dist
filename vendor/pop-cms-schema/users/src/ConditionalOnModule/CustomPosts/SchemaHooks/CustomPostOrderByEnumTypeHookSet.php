<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\SchemaHooks;

use PoP\Root\App;
use PoP\ComponentModel\TypeResolvers\EnumType\EnumTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\EnumType\HookNames;
use PoP\Root\Hooks\AbstractHookSet;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostOrderByEnumTypeResolver;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\Constants\CustomPostOrderBy;
/** @internal */
class CustomPostOrderByEnumTypeHookSet extends AbstractHookSet
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
        if (!$enumTypeResolver instanceof CustomPostOrderByEnumTypeResolver) {
            return $enumValues;
        }
        return \array_merge($enumValues, [CustomPostOrderBy::AUTHOR]);
    }
    public function getEnumValueDescription(?string $enumValueDescription, EnumTypeResolverInterface $enumTypeResolver, string $enumValue) : ?string
    {
        if (!$enumTypeResolver instanceof CustomPostOrderByEnumTypeResolver) {
            return $enumValueDescription;
        }
        switch ($enumValue) {
            case CustomPostOrderBy::AUTHOR:
                return $this->__('Order by custom post author', 'pop-users');
            default:
                return $enumValueDescription;
        }
    }
}
