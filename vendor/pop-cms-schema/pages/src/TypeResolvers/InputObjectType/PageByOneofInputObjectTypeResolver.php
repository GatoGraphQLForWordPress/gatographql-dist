<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractCustomPostByOneofInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\PathOrPathsFilterInput;
/** @internal */
class PageByOneofInputObjectTypeResolver extends AbstractCustomPostByOneofInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\PathOrPathsFilterInput|null
     */
    private $pathOrPathsFilterInput;
    protected final function getPathOrPathsFilterInput() : PathOrPathsFilterInput
    {
        if ($this->pathOrPathsFilterInput === null) {
            /** @var PathOrPathsFilterInput */
            $pathOrPathsFilterInput = $this->instanceManager->getInstance(PathOrPathsFilterInput::class);
            $this->pathOrPathsFilterInput = $pathOrPathsFilterInput;
        }
        return $this->pathOrPathsFilterInput;
    }
    public function getTypeName() : string
    {
        return 'PageByInput';
    }
    protected function getTypeDescriptionCustomPostEntity() : string
    {
        return $this->__('a page', 'pages');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['path' => $this->getStringScalarTypeResolver()]);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'path':
                return $this->__('Query by page path', 'pages');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'path':
                return $this->getPathOrPathsFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
