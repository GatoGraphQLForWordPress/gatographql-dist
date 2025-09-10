<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class CreateMediaItemFromOneofInputObjectTypeResolver extends AbstractOneofInputObjectTypeResolver
{
    private ?\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver $createMediaItemFromContentInputObjectTypeResolver = null;
    private ?\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromURLInputObjectTypeResolver $createMediaItemFromURLInputObjectTypeResolver = null;
    private ?MediaItemByOneofInputObjectTypeResolver $mediaItemByOneofInputObjectTypeResolver = null;
    protected final function getCreateMediaItemFromContentInputObjectTypeResolver() : \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver
    {
        if ($this->createMediaItemFromContentInputObjectTypeResolver === null) {
            /** @var CreateMediaItemFromContentInputObjectTypeResolver */
            $createMediaItemFromContentInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver::class);
            $this->createMediaItemFromContentInputObjectTypeResolver = $createMediaItemFromContentInputObjectTypeResolver;
        }
        return $this->createMediaItemFromContentInputObjectTypeResolver;
    }
    protected final function getCreateMediaItemFromURLInputObjectTypeResolver() : \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromURLInputObjectTypeResolver
    {
        if ($this->createMediaItemFromURLInputObjectTypeResolver === null) {
            /** @var CreateMediaItemFromURLInputObjectTypeResolver */
            $createMediaItemFromURLInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromURLInputObjectTypeResolver::class);
            $this->createMediaItemFromURLInputObjectTypeResolver = $createMediaItemFromURLInputObjectTypeResolver;
        }
        return $this->createMediaItemFromURLInputObjectTypeResolver;
    }
    protected final function getMediaItemByOneofInputObjectTypeResolver() : MediaItemByOneofInputObjectTypeResolver
    {
        if ($this->mediaItemByOneofInputObjectTypeResolver === null) {
            /** @var MediaItemByOneofInputObjectTypeResolver */
            $mediaItemByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(MediaItemByOneofInputObjectTypeResolver::class);
            $this->mediaItemByOneofInputObjectTypeResolver = $mediaItemByOneofInputObjectTypeResolver;
        }
        return $this->mediaItemByOneofInputObjectTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'CreateMediaItemFromInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::MEDIAITEM_BY => $this->getMediaItemByOneofInputObjectTypeResolver(), MutationInputProperties::URL => $this->getCreateMediaItemFromURLInputObjectTypeResolver(), MutationInputProperties::CONTENTS => $this->getCreateMediaItemFromContentInputObjectTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            MutationInputProperties::MEDIAITEM_BY => $this->__('Use the attachment from an existing media item', 'media-mutations'),
            MutationInputProperties::URL => $this->__('Upload the attachment from a URL', 'media-mutations'),
            MutationInputProperties::CONTENTS => $this->__('Create the attachment by passing the file name and body', 'media-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
}
