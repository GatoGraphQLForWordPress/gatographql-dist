<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\TypeResolvers\InputObjectType;

use PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Media\Constants\InputProperties;
/** @internal */
class MediaItemByOneofInputObjectTypeResolver extends AbstractOneofQueryableInputObjectTypeResolver
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
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput|null
     */
    private $includeFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput|null
     */
    private $slugFilterInput;
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
    public final function setIncludeFilterInput(IncludeFilterInput $includeFilterInput) : void
    {
        $this->includeFilterInput = $includeFilterInput;
    }
    protected final function getIncludeFilterInput() : IncludeFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var IncludeFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(IncludeFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    public final function setSlugFilterInput(SlugFilterInput $slugFilterInput) : void
    {
        $this->slugFilterInput = $slugFilterInput;
    }
    protected final function getSlugFilterInput() : SlugFilterInput
    {
        if ($this->slugFilterInput === null) {
            /** @var SlugFilterInput */
            $slugFilterInput = $this->instanceManager->getInstance(SlugFilterInput::class);
            $this->slugFilterInput = $slugFilterInput;
        }
        return $this->slugFilterInput;
    }
    public function getTypeName() : string
    {
        return 'MediaItemByInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Oneof input to specify the property and data to fetch a media item', 'media');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [InputProperties::ID => $this->getIDScalarTypeResolver(), InputProperties::SLUG => $this->getStringScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->__('Query by media item ID', 'media');
            case InputProperties::SLUG:
                return $this->__('Query by media item slug', 'media');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->getIncludeFilterInput();
            case InputProperties::SLUG:
                return $this->getSlugFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
