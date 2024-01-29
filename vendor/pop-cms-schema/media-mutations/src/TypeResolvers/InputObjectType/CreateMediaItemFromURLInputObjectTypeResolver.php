<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
class CreateMediaItemFromURLInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    public final function setURLScalarTypeResolver(URLScalarTypeResolver $urlScalarTypeResolver) : void
    {
        $this->urlScalarTypeResolver = $urlScalarTypeResolver;
    }
    protected final function getURLScalarTypeResolver() : URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
    }
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
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
    public function getTypeName() : string
    {
        return 'CreateMediaItemFromURLInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Create and upload the attachment from a URL', 'media-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::FILENAME => $this->getStringScalarTypeResolver(), MutationInputProperties::SOURCE => $this->getURLScalarTypeResolver()];
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::SOURCE:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::FILENAME:
                return $this->__('File name (to override the one from the URL source)', 'media-mutations');
            case MutationInputProperties::SOURCE:
                return $this->__('URL source', 'media-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
