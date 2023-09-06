<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Media\Constants\InputProperties;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
class FeaturedImageByOneofInputObjectTypeResolver extends MediaItemByOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'FeaturedImageByInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Oneof input to specify the custom post\'s featured image', 'custompostmedia-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->__('Provide featured image by ID', 'custompostmedia-mutations');
            case InputProperties::SLUG:
                return $this->__('Provide featured image by slug', 'custompostmedia-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        return null;
    }
    protected function isOneInputValueMandatory() : bool
    {
        return \false;
    }
    protected function isOneOfInputPropertyNullable(string $propertyName) : bool
    {
        switch ($propertyName) {
            case InputProperties::ID:
            case InputProperties::SLUG:
                return \true;
            default:
                return parent::isOneOfInputPropertyNullable($propertyName);
        }
    }
}
