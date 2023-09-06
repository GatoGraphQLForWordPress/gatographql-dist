<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\SchemaHooks;

use PoPCMSSchema\Users\TypeResolvers\InputObjectType\FilterByAuthorInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
trait AddOrRemoveAuthorInputFieldsInputObjectTypeHookSetTrait
{
    protected abstract function getFilterByAuthorInputObjectTypeResolver() : FilterByAuthorInputObjectTypeResolver;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    protected function getAuthorInputFieldNameTypeResolvers() : array
    {
        return ['author' => $this->getFilterByAuthorInputObjectTypeResolver()];
    }
}
