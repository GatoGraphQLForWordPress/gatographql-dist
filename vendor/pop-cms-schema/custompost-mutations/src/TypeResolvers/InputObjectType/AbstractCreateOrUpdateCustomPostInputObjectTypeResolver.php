<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CustomPostMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostParentByOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver;
use PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\NonEmptyStringScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractCreateOrUpdateCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateCustomPostInputObjectTypeResolverInterface, \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CreateCustomPostInputObjectTypeResolverInterface
{
    private ?CustomPostStatusEnumTypeResolver $customPostStatusEnumTypeResolver = null;
    private ?IDScalarTypeResolver $idScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
    private ?NonEmptyStringScalarTypeResolver $nonEmptyStringScalarTypeResolver = null;
    private ?\PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\CustomPostContentAsOneofInputObjectTypeResolver $customPostContentAsOneofInputObjectTypeResolver = null;
    private ?DateTimeScalarTypeResolver $dateTimeScalarTypeResolver = null;
    private ?CustomPostParentByOneofInputObjectTypeResolver $customPostParentByOneofInputObjectTypeResolver = null;
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
    protected final function getNonEmptyStringScalarTypeResolver() : NonEmptyStringScalarTypeResolver
    {
        if ($this->nonEmptyStringScalarTypeResolver === null) {
            /** @var NonEmptyStringScalarTypeResolver */
            $nonEmptyStringScalarTypeResolver = $this->instanceManager->getInstance(NonEmptyStringScalarTypeResolver::class);
            $this->nonEmptyStringScalarTypeResolver = $nonEmptyStringScalarTypeResolver;
        }
        return $this->nonEmptyStringScalarTypeResolver;
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
    protected final function getCustomPostParentByOneofInputObjectTypeResolver() : CustomPostParentByOneofInputObjectTypeResolver
    {
        if ($this->customPostParentByOneofInputObjectTypeResolver === null) {
            /** @var CustomPostParentByOneofInputObjectTypeResolver */
            $customPostParentByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostParentByOneofInputObjectTypeResolver::class);
            $this->customPostParentByOneofInputObjectTypeResolver = $customPostParentByOneofInputObjectTypeResolver;
        }
        return $this->customPostParentByOneofInputObjectTypeResolver;
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
        return \array_merge($this->addCustomPostInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], $this->addCustomPostParentInputField() ? [MutationInputProperties::PARENT_BY => $this->getCustomPostParentByOneofInputObjectTypeResolver()] : [], [MutationInputProperties::TITLE => $this->getStringScalarTypeResolver(), MutationInputProperties::CONTENT_AS => $this->getContentAsOneofInputObjectTypeResolver(), MutationInputProperties::EXCERPT => $this->getStringScalarTypeResolver(), MutationInputProperties::SLUG => $this->getNonEmptyStringScalarTypeResolver(), MutationInputProperties::STATUS => $this->getCustomPostStatusEnumTypeResolver(), MutationInputProperties::DATE => $this->getDateTimeScalarTypeResolver(), MutationInputProperties::GMT_DATE => $this->getDateTimeScalarTypeResolver()]);
    }
    protected function getContentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver
    {
        return $this->getCustomPostContentAsOneofInputObjectTypeResolver();
    }
    protected abstract function addCustomPostInputField() : bool;
    protected abstract function addCustomPostParentInputField() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => $this->__('The ID of the custom post to update', 'custompost-mutations'),
            MutationInputProperties::PARENT_BY => $this->__('The parent of the custom post. Pass `null` to remove the parent', 'custompost-mutations'),
            MutationInputProperties::TITLE => $this->__('The title of the custom post', 'custompost-mutations'),
            MutationInputProperties::CONTENT_AS => $this->__('The content of the custom post', 'custompost-mutations'),
            MutationInputProperties::EXCERPT => $this->__('The excerpt of the custom post', 'custompost-mutations'),
            MutationInputProperties::SLUG => $this->__('The slug of the custom post', 'custompost-mutations'),
            MutationInputProperties::STATUS => $this->__('The status of the custom post', 'custompost-mutations'),
            MutationInputProperties::DATE => $this->__('The date of the custom post', 'custompost-mutations'),
            MutationInputProperties::GMT_DATE => $this->__('The date in GMT of the custom post', 'custompost-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => SchemaTypeModifiers::MANDATORY,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
}
