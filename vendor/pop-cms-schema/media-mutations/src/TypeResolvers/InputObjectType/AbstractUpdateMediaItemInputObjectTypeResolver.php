<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MediaMutations\Constants\MediaCRUDHookNames;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractUpdateMediaItemInputObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateMediaItemInputObjectTypeResolver implements \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\UpdateMediaItemInputObjectTypeResolverInterface
{
    protected function addMediaItemInputField() : bool
    {
        return \true;
    }
    protected function canUploadAttachment() : bool
    {
        return \false;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return App::applyFilters(MediaCRUDHookNames::UPDATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS, parent::getInputFieldNameTypeResolvers(), $this);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return App::applyFilters(MediaCRUDHookNames::UPDATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION, parent::getInputFieldDescription($inputFieldName), $inputFieldName, $this);
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return App::applyFilters(MediaCRUDHookNames::UPDATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS, parent::getInputFieldTypeModifiers($inputFieldName), $inputFieldName, $this);
    }
}
