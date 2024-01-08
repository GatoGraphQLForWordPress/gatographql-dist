<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostTagMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\TagsByOneofInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\TagObjectTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
/** @internal */
abstract class AbstractSetTagsOnCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\TagsByOneofInputObjectTypeResolver|null
     */
    private $tagsByOneofInputObjectTypeResolver;
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    public final function setTagsByOneofInputObjectTypeResolver(TagsByOneofInputObjectTypeResolver $tagsByOneofInputObjectTypeResolver) : void
    {
        $this->tagsByOneofInputObjectTypeResolver = $tagsByOneofInputObjectTypeResolver;
    }
    protected final function getTagsByOneofInputObjectTypeResolver() : TagsByOneofInputObjectTypeResolver
    {
        if ($this->tagsByOneofInputObjectTypeResolver === null) {
            /** @var TagsByOneofInputObjectTypeResolver */
            $tagsByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(TagsByOneofInputObjectTypeResolver::class);
            $this->tagsByOneofInputObjectTypeResolver = $tagsByOneofInputObjectTypeResolver;
        }
        return $this->tagsByOneofInputObjectTypeResolver;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set tags on a custom post', 'comment-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addCustomPostInputField() ? [MutationInputProperties::CUSTOMPOST_ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::TAGS_BY => $this->getTagsByOneofInputObjectTypeResolver(), MutationInputProperties::APPEND => $this->getBooleanScalarTypeResolver()]);
    }
    protected abstract function addCustomPostInputField() : bool;
    protected abstract function getEntityName() : string;
    protected abstract function getTagTypeResolver() : TagObjectTypeResolverInterface;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_ID:
                return \sprintf($this->__('The ID of the %s', 'custompost-tag-mutations'), $this->getEntityName());
            case MutationInputProperties::TAGS_BY:
                return \sprintf($this->__('The tags to set, of type \'%s\'', 'custompost-tag-mutations'), $this->getTagTypeResolver()->getMaybeNamespacedTypeName());
            case MutationInputProperties::APPEND:
                return $this->__('Append the tags to the existing ones?', 'custompost-tag-mutations');
            default:
                return null;
        }
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case MutationInputProperties::APPEND:
                return \false;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::APPEND:
                return SchemaTypeModifiers::NON_NULLABLE;
            case MutationInputProperties::CUSTOMPOST_ID:
            case MutationInputProperties::TAGS_BY:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
