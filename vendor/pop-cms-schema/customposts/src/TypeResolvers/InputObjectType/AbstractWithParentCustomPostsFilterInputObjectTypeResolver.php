<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractCustomPostsFilterInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeParentIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDsFilterInput;
/** @internal */
abstract class AbstractWithParentCustomPostsFilterInputObjectTypeResolver extends AbstractCustomPostsFilterInputObjectTypeResolver implements \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\WithParentCustomPostsFilterInputObjectTypeResolverInterface
{
    private ?ParentIDFilterInput $parentIDFilterInput = null;
    private ?ParentIDsFilterInput $parentIDsFilterInput = null;
    private ?ExcludeParentIDsFilterInput $excludeParentIDsFilterInput = null;
    protected final function getParentIDFilterInput() : ParentIDFilterInput
    {
        if ($this->parentIDFilterInput === null) {
            /** @var ParentIDFilterInput */
            $parentIDFilterInput = $this->instanceManager->getInstance(ParentIDFilterInput::class);
            $this->parentIDFilterInput = $parentIDFilterInput;
        }
        return $this->parentIDFilterInput;
    }
    protected final function getParentIDsFilterInput() : ParentIDsFilterInput
    {
        if ($this->parentIDsFilterInput === null) {
            /** @var ParentIDsFilterInput */
            $parentIDsFilterInput = $this->instanceManager->getInstance(ParentIDsFilterInput::class);
            $this->parentIDsFilterInput = $parentIDsFilterInput;
        }
        return $this->parentIDsFilterInput;
    }
    protected final function getExcludeParentIDsFilterInput() : ExcludeParentIDsFilterInput
    {
        if ($this->excludeParentIDsFilterInput === null) {
            /** @var ExcludeParentIDsFilterInput */
            $excludeParentIDsFilterInput = $this->instanceManager->getInstance(ExcludeParentIDsFilterInput::class);
            $this->excludeParentIDsFilterInput = $excludeParentIDsFilterInput;
        }
        return $this->excludeParentIDsFilterInput;
    }
    protected abstract function addParentInputFields() : bool;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), $this->addParentInputFields() ? ['parentID' => $this->getIDScalarTypeResolver(), 'parentIDs' => $this->getIDScalarTypeResolver(), 'excludeParentIDs' => $this->getIDScalarTypeResolver()] : []);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            'parentID' => $this->__('Filter custom posts with the given parent IDs. \'0\' means \'no parent\'', 'customposts'),
            'parentIDs' => $this->__('Filter custom posts with the given parent ID. \'0\' means \'no parent\'', 'customposts'),
            'excludeParentIDs' => $this->__('Exclude custom posts with the given parent IDs', 'customposts'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return match ($inputFieldName) {
            'parentIDs', 'excludeParentIDs' => SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        return match ($inputFieldName) {
            'parentID' => $this->getParentIDFilterInput(),
            'parentIDs' => $this->getParentIDsFilterInput(),
            'excludeParentIDs' => $this->getExcludeParentIDsFilterInput(),
            default => parent::getInputFieldFilterInput($inputFieldName),
        };
    }
}
