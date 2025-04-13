<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractAddEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractAddCustomPostMetaInputObjectTypeResolver extends AbstractAddEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AddCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to add meta to a custom post', 'custompostmeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the custom post', 'custompostmeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
