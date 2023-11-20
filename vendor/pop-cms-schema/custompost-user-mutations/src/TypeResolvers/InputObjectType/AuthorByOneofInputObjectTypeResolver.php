<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostUserMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Users\Constants\InputProperties;
use PoPCMSSchema\Users\TypeResolvers\InputObjectType\UserByOneofInputObjectTypeResolver;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
/** @internal */
class AuthorByOneofInputObjectTypeResolver extends UserByOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'AuthorByInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Oneof input to specify the custom post author', 'custompost-user-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->__('Provide author by ID', 'custompost-user-mutations');
            case InputProperties::USERNAME:
                return $this->__('Provide author by username', 'custompost-user-mutations');
            case InputProperties::EMAIL:
                return $this->__('Provide author by email', 'custompost-user-mutations');
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
}
