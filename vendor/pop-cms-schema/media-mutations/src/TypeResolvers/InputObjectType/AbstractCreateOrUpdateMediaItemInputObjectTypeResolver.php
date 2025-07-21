<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MediaMutations\Constants\MediaCRUDHookNames;
use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateScalarTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractCreateOrUpdateMediaItemInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemInputObjectTypeResolverInterface
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromOneofInputObjectTypeResolver|null
     */
    private $createMediaItemFromOneofInputObjectTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateScalarTypeResolver|null
     */
    private $dateScalarTypeResolver;
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
    protected final function getCreateMediaItemFromOneofInputObjectTypeResolver() : \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromOneofInputObjectTypeResolver
    {
        if ($this->createMediaItemFromOneofInputObjectTypeResolver === null) {
            /** @var CreateMediaItemFromOneofInputObjectTypeResolver */
            $createMediaItemFromOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromOneofInputObjectTypeResolver::class);
            $this->createMediaItemFromOneofInputObjectTypeResolver = $createMediaItemFromOneofInputObjectTypeResolver;
        }
        return $this->createMediaItemFromOneofInputObjectTypeResolver;
    }
    protected final function getDateScalarTypeResolver() : DateScalarTypeResolver
    {
        if ($this->dateScalarTypeResolver === null) {
            /** @var DateScalarTypeResolver */
            $dateScalarTypeResolver = $this->instanceManager->getInstance(DateScalarTypeResolver::class);
            $this->dateScalarTypeResolver = $dateScalarTypeResolver;
        }
        return $this->dateScalarTypeResolver;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        $inputFieldNameTypeResolvers = \array_merge($this->addMediaItemInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], $this->canUploadAttachment() ? [MutationInputProperties::FROM => $this->getCreateMediaItemFromOneofInputObjectTypeResolver()] : [], [MutationInputProperties::AUTHOR_ID => $this->getIDScalarTypeResolver(), MutationInputProperties::TITLE => $this->getStringScalarTypeResolver(), MutationInputProperties::SLUG => $this->getStringScalarTypeResolver(), MutationInputProperties::CAPTION => $this->getStringScalarTypeResolver(), MutationInputProperties::DESCRIPTION => $this->getStringScalarTypeResolver(), MutationInputProperties::ALT_TEXT => $this->getStringScalarTypeResolver(), MutationInputProperties::MIME_TYPE => $this->getStringScalarTypeResolver(), MutationInputProperties::DATE => $this->getDateScalarTypeResolver(), MutationInputProperties::GMT_DATE => $this->getDateScalarTypeResolver()]);
        // Inject custom post ID, etc
        $inputFieldNameTypeResolvers = App::applyFilters(MediaCRUDHookNames::CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS, $inputFieldNameTypeResolvers, $this);
        return $inputFieldNameTypeResolvers;
    }
    protected abstract function addMediaItemInputField() : bool;
    protected abstract function canUploadAttachment() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                $inputFieldDescription = $this->__('Media item ID', 'media-mutations');
                break;
            case MutationInputProperties::FROM:
                $inputFieldDescription = $this->__('Source for the file', 'media-mutations');
                break;
            case MutationInputProperties::AUTHOR_ID:
                $inputFieldDescription = $this->__('The ID of the author', 'media-mutations');
                break;
            case MutationInputProperties::TITLE:
                $inputFieldDescription = $this->__('Attachment title', 'media-mutations');
                break;
            case MutationInputProperties::SLUG:
                $inputFieldDescription = $this->__('Attachment slug', 'media-mutations');
                break;
            case MutationInputProperties::CAPTION:
                $inputFieldDescription = $this->__('Attachment caption', 'media-mutations');
                break;
            case MutationInputProperties::DESCRIPTION:
                $inputFieldDescription = $this->__('Attachment description', 'media-mutations');
                break;
            case MutationInputProperties::ALT_TEXT:
                $inputFieldDescription = $this->__('Image alternative information', 'media-mutations');
                break;
            case MutationInputProperties::MIME_TYPE:
                $inputFieldDescription = $this->__('Mime type to use for the attachment, when this information can\'t be deduced from the filename (because it has no extension)', 'media-mutations');
                break;
            case MutationInputProperties::DATE:
                $inputFieldDescription = $this->__('Date to use for the attachment', 'media-mutations');
                break;
            case MutationInputProperties::GMT_DATE:
                $inputFieldDescription = $this->__('GMT date to use for the attachment', 'media-mutations');
                break;
            default:
                $inputFieldDescription = parent::getInputFieldDefaultValue($inputFieldName);
                break;
        }
        // Inject custom post ID, etc
        $inputFieldDescription = App::applyFilters(MediaCRUDHookNames::CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION, $inputFieldDescription, $inputFieldName, $this);
        return $inputFieldDescription;
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                $inputFieldTypeModifiers = SchemaTypeModifiers::MANDATORY;
                break;
            case MutationInputProperties::FROM:
                $inputFieldTypeModifiers = SchemaTypeModifiers::MANDATORY;
                break;
            default:
                $inputFieldTypeModifiers = parent::getInputFieldTypeModifiers($inputFieldName);
                break;
        }
        // Inject custom post ID, etc
        $inputFieldTypeModifiers = App::applyFilters(MediaCRUDHookNames::CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS, $inputFieldTypeModifiers, $inputFieldName, $this);
        return $inputFieldTypeModifiers;
    }
}
