<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\Constants\MutationInputProperties;
/** @internal */
class RootRemoveFeaturedImageFromCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'RootRemoveFeaturedImageFromCustomPostInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to remove the featured image from a custom post', 'custompostmedia-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::CUSTOMPOST_ID => $this->getIDScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_ID:
                return $this->__('The ID of the custom post', 'custompostmedia-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::CUSTOMPOST_ID:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
