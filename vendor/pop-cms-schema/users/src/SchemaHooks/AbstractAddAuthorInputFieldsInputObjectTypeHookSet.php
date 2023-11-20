<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\SchemaHooks;

use PoPCMSSchema\Users\TypeResolvers\InputObjectType\FilterByAuthorInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputObjectType\HookNames;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
/** @internal */
abstract class AbstractAddAuthorInputFieldsInputObjectTypeHookSet extends AbstractHookSet
{
    use \PoPCMSSchema\Users\SchemaHooks\AddOrRemoveAuthorInputFieldsInputObjectTypeHookSetTrait;
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\InputObjectType\FilterByAuthorInputObjectTypeResolver|null
     */
    private $filterByAuthorInputObjectTypeResolver;
    public final function setFilterByAuthorInputObjectTypeResolver(FilterByAuthorInputObjectTypeResolver $filterByAuthorInputObjectTypeResolver) : void
    {
        $this->filterByAuthorInputObjectTypeResolver = $filterByAuthorInputObjectTypeResolver;
    }
    protected final function getFilterByAuthorInputObjectTypeResolver() : FilterByAuthorInputObjectTypeResolver
    {
        if ($this->filterByAuthorInputObjectTypeResolver === null) {
            /** @var FilterByAuthorInputObjectTypeResolver */
            $filterByAuthorInputObjectTypeResolver = $this->instanceManager->getInstance(FilterByAuthorInputObjectTypeResolver::class);
            $this->filterByAuthorInputObjectTypeResolver = $filterByAuthorInputObjectTypeResolver;
        }
        return $this->filterByAuthorInputObjectTypeResolver;
    }
    protected function init() : void
    {
        App::addFilter(HookNames::INPUT_FIELD_NAME_TYPE_RESOLVERS, \Closure::fromCallable([$this, 'getInputFieldNameTypeResolvers']), 10, 2);
        App::addFilter(HookNames::INPUT_FIELD_DESCRIPTION, \Closure::fromCallable([$this, 'getInputFieldDescription']), 10, 3);
    }
    /**
     * Indicate if to add the fields added by the SchemaHookSet
     */
    protected abstract function addAuthorInputFields(InputObjectTypeResolverInterface $inputObjectTypeResolver) : bool;
    /**
     * @param array<string,InputTypeResolverInterface> $inputFieldNameTypeResolvers
     * @return array<string,InputTypeResolverInterface>|mixed[]
     */
    public function getInputFieldNameTypeResolvers(array $inputFieldNameTypeResolvers, InputObjectTypeResolverInterface $inputObjectTypeResolver) : array
    {
        if (!$this->addAuthorInputFields($inputObjectTypeResolver)) {
            return $inputFieldNameTypeResolvers;
        }
        return \array_merge($inputFieldNameTypeResolvers, $this->getAuthorInputFieldNameTypeResolvers());
    }
    public function getInputFieldDescription(?string $inputFieldDescription, InputObjectTypeResolverInterface $inputObjectTypeResolver, string $inputFieldName) : ?string
    {
        if (!$this->addAuthorInputFields($inputObjectTypeResolver)) {
            return $inputFieldDescription;
        }
        switch ($inputFieldName) {
            case 'author':
                return $this->__('Filter by author', 'pop-users');
            default:
                return $inputFieldDescription;
        }
    }
}
