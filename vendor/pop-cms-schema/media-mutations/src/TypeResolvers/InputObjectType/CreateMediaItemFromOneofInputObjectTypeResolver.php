<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class CreateMediaItemFromOneofInputObjectTypeResolver extends AbstractOneofInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver|null
     */
    private $createMediaItemFromContentInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromURLInputObjectTypeResolver|null
     */
    private $createMediaItemFromURLInputObjectTypeResolver;
    public final function setCreateMediaItemFromContentInputObjectTypeResolver(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver $createMediaItemFromContentInputObjectTypeResolver) : void
    {
        $this->createMediaItemFromContentInputObjectTypeResolver = $createMediaItemFromContentInputObjectTypeResolver;
    }
    protected final function getCreateMediaItemFromContentInputObjectTypeResolver() : \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver
    {
        if ($this->createMediaItemFromContentInputObjectTypeResolver === null) {
            /** @var CreateMediaItemFromContentInputObjectTypeResolver */
            $createMediaItemFromContentInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromContentInputObjectTypeResolver::class);
            $this->createMediaItemFromContentInputObjectTypeResolver = $createMediaItemFromContentInputObjectTypeResolver;
        }
        return $this->createMediaItemFromContentInputObjectTypeResolver;
    }
    public final function setCreateMediaItemFromURLInputObjectTypeResolver(\PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\CreateMediaItemFromURLInputObjectTypeResolver $createMediaItemFromURLInputObjectTypeResolver) : void
    {
        $this->createMediaItemFromURLInputObjectTypeResolver = $createMediaItemFromURLInputObjectTypeResolver;
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
    public function getTypeName() : string
    {
        return 'CreateMediaItemFromInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::URL => $this->getCreateMediaItemFromURLInputObjectTypeResolver(), MutationInputProperties::CONTENTS => $this->getCreateMediaItemFromContentInputObjectTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::URL:
                return $this->__('Upload the attachment from a URL', 'media-mutations');
            case MutationInputProperties::CONTENTS:
                return $this->__('Create the attachment by passing the file name and body', 'media-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
