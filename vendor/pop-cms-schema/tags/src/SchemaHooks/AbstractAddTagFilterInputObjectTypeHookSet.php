<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\SchemaHooks;

use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\FilterCustomPostsByTagsInputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\HookNames;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
/** @internal */
abstract class AbstractAddTagFilterInputObjectTypeHookSet extends AbstractHookSet
{
    protected function init() : void
    {
        App::addFilter(HookNames::INPUT_FIELD_NAME_TYPE_RESOLVERS, \Closure::fromCallable([$this, 'getInputFieldNameTypeResolvers']), 10, 2);
        App::addFilter(HookNames::INPUT_FIELD_DESCRIPTION, \Closure::fromCallable([$this, 'getInputFieldDescription']), 10, 3);
    }
    /**
     * @param array<string,InputTypeResolverInterface> $inputFieldNameTypeResolvers
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(array $inputFieldNameTypeResolvers, InputObjectTypeResolverInterface $inputObjectTypeResolver) : array
    {
        if (!\is_a($inputObjectTypeResolver, $this->getInputObjectTypeResolverClass(), \true)) {
            return $inputFieldNameTypeResolvers;
        }
        return \array_merge($inputFieldNameTypeResolvers, ['tags' => $this->getFilterCustomPostsByTagsInputObjectTypeResolver()]);
    }
    protected abstract function getInputObjectTypeResolverClass() : string;
    protected abstract function getFilterCustomPostsByTagsInputObjectTypeResolver() : FilterCustomPostsByTagsInputObjectTypeResolverInterface;
    public function getInputFieldDescription(?string $inputFieldDescription, InputObjectTypeResolverInterface $inputObjectTypeResolver, string $inputFieldName) : ?string
    {
        if (!\is_a($inputObjectTypeResolver, $this->getInputObjectTypeResolverClass(), \true)) {
            return $inputFieldDescription;
        }
        switch ($inputFieldName) {
            case 'tags':
                return $this->__('Filter by tags', 'tags');
            default:
                return $inputFieldDescription;
        }
    }
}
