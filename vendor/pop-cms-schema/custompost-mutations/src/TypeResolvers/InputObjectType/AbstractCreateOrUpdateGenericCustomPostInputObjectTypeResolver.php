<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateGenericCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateGenericCustomPostInputObjectTypeResolverInterface, \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CreateGenericCustomPostInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver|null
     */
    private $customPostEnumStringScalarTypeResolver;
    protected final function getCustomPostEnumStringScalarTypeResolver() : CustomPostEnumStringScalarTypeResolver
    {
        if ($this->customPostEnumStringScalarTypeResolver === null) {
            /** @var CustomPostEnumStringScalarTypeResolver */
            $customPostEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CustomPostEnumStringScalarTypeResolver::class);
            $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
        }
        return $this->customPostEnumStringScalarTypeResolver;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), [MutationInputProperties::CUSTOMPOST_TYPE => $this->getCustomPostEnumStringScalarTypeResolver()]);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_TYPE:
                return $this->__('The custom post type', 'custompost-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_TYPE:
                return $this->isCustomPostTypeFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    protected abstract function isCustomPostTypeFieldMandatory() : bool;
}
