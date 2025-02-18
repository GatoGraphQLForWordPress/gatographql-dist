<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractCreateOrUpdateCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateCustomPostInputObjectTypeResolverInterface, \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CreateCustomPostInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver|null
     */
    private $customPostStatusEnumTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostContentAsOneofInputObjectTypeResolver|null
     */
    private $customPostContentAsOneofInputObjectTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver|null
     */
    private $dateTimeScalarTypeResolver;
    protected final function getCustomPostStatusEnumTypeResolver() : CustomPostStatusEnumTypeResolver
    {
        if ($this->customPostStatusEnumTypeResolver === null) {
            /** @var CustomPostStatusEnumTypeResolver */
            $customPostStatusEnumTypeResolver = $this->instanceManager->getInstance(CustomPostStatusEnumTypeResolver::class);
            $this->customPostStatusEnumTypeResolver = $customPostStatusEnumTypeResolver;
        }
        return $this->customPostStatusEnumTypeResolver;
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
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getCustomPostContentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostContentAsOneofInputObjectTypeResolver
    {
        if ($this->customPostContentAsOneofInputObjectTypeResolver === null) {
            /** @var CustomPostContentAsOneofInputObjectTypeResolver */
            $customPostContentAsOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostContentAsOneofInputObjectTypeResolver::class);
            $this->customPostContentAsOneofInputObjectTypeResolver = $customPostContentAsOneofInputObjectTypeResolver;
        }
        return $this->customPostContentAsOneofInputObjectTypeResolver;
    }
    protected final function getDateTimeScalarTypeResolver() : DateTimeScalarTypeResolver
    {
        if ($this->dateTimeScalarTypeResolver === null) {
            /** @var DateTimeScalarTypeResolver */
            $dateTimeScalarTypeResolver = $this->instanceManager->getInstance(DateTimeScalarTypeResolver::class);
            $this->dateTimeScalarTypeResolver = $dateTimeScalarTypeResolver;
        }
        return $this->dateTimeScalarTypeResolver;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a custom post', 'custompost-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addCustomPostInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::TITLE => $this->getStringScalarTypeResolver(), MutationInputProperties::CONTENT_AS => $this->getContentAsOneofInputObjectTypeResolver(), MutationInputProperties::EXCERPT => $this->getStringScalarTypeResolver(), MutationInputProperties::SLUG => $this->getStringScalarTypeResolver(), MutationInputProperties::STATUS => $this->getCustomPostStatusEnumTypeResolver(), MutationInputProperties::DATE => $this->getDateTimeScalarTypeResolver(), MutationInputProperties::GMT_DATE => $this->getDateTimeScalarTypeResolver()]);
    }
    protected function getContentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getCustomPostContentAsOneofInputObjectTypeResolver();
    }
    protected abstract function addCustomPostInputField() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the custom post to update', 'custompost-mutations');
            case MutationInputProperties::TITLE:
                return $this->__('The title of the custom post', 'custompost-mutations');
            case MutationInputProperties::CONTENT_AS:
                return $this->__('The content of the custom post', 'custompost-mutations');
            case MutationInputProperties::EXCERPT:
                return $this->__('The excerpt of the custom post', 'custompost-mutations');
            case MutationInputProperties::SLUG:
                return $this->__('The slug of the custom post', 'custompost-mutations');
            case MutationInputProperties::STATUS:
                return $this->__('The status of the custom post', 'custompost-mutations');
            case MutationInputProperties::DATE:
                return $this->__('The date of the custom post', 'custompost-mutations');
            case MutationInputProperties::GMT_DATE:
                return $this->__('The date in GMT of the custom post', 'custompost-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
