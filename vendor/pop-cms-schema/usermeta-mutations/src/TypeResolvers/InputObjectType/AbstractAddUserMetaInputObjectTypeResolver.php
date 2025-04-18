<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractAddEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractAddUserMetaInputObjectTypeResolver extends AbstractAddEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AddUserMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to add meta to a user', 'usermeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the user', 'usermeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
