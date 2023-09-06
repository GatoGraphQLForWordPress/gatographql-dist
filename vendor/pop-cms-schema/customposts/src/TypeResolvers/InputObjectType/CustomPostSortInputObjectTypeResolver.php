<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoPCMSSchema\CustomPosts\Constants\CustomPostOrderBy;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostOrderByEnumTypeResolver;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\SortInputObjectTypeResolver;
class CustomPostSortInputObjectTypeResolver extends SortInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostOrderByEnumTypeResolver|null
     */
    private $customPostSortByEnumTypeResolver;
    public final function setCustomPostOrderByEnumTypeResolver(CustomPostOrderByEnumTypeResolver $customPostSortByEnumTypeResolver) : void
    {
        $this->customPostSortByEnumTypeResolver = $customPostSortByEnumTypeResolver;
    }
    protected final function getCustomPostOrderByEnumTypeResolver() : CustomPostOrderByEnumTypeResolver
    {
        if ($this->customPostSortByEnumTypeResolver === null) {
            /** @var CustomPostOrderByEnumTypeResolver */
            $customPostSortByEnumTypeResolver = $this->instanceManager->getInstance(CustomPostOrderByEnumTypeResolver::class);
            $this->customPostSortByEnumTypeResolver = $customPostSortByEnumTypeResolver;
        }
        return $this->customPostSortByEnumTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'CustomPostSortInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['by' => $this->getCustomPostOrderByEnumTypeResolver()]);
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'by':
                return CustomPostOrderBy::DATE;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
}
