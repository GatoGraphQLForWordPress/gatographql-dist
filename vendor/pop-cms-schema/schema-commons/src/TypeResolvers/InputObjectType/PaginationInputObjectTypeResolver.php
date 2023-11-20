<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoPCMSSchema\SchemaCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPCMSSchema\SchemaCommons\FilterInputs\LimitFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\OffsetFilterInput;
/** @internal */
class PaginationInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\OffsetFilterInput|null
     */
    private $excludeIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\LimitFilterInput|null
     */
    private $includeFilterInput;
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    public final function setOffsetFilterInput(OffsetFilterInput $excludeIDsFilterInput) : void
    {
        $this->excludeIDsFilterInput = $excludeIDsFilterInput;
    }
    protected final function getOffsetFilterInput() : OffsetFilterInput
    {
        if ($this->excludeIDsFilterInput === null) {
            /** @var OffsetFilterInput */
            $excludeIDsFilterInput = $this->instanceManager->getInstance(OffsetFilterInput::class);
            $this->excludeIDsFilterInput = $excludeIDsFilterInput;
        }
        return $this->excludeIDsFilterInput;
    }
    public final function setLimitFilterInput(LimitFilterInput $includeFilterInput) : void
    {
        $this->includeFilterInput = $includeFilterInput;
    }
    protected final function getLimitFilterInput() : LimitFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var LimitFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(LimitFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    public function getTypeName() : string
    {
        return 'PaginationInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['limit' => $this->getIntScalarTypeResolver(), 'offset' => $this->getIntScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        $maxLimit = $this->getMaxLimit();
        switch ($maxLimit) {
            case null:
                $limitDesc = $this->__('Limit the results. \'-1\' brings all the results (or the maximum amount allowed)', 'schema-commons');
                break;
            case -1:
                $limitDesc = $this->__('Limit the results. \'-1\' brings all the results', 'schema-commons');
                break;
            default:
                $limitDesc = \sprintf($this->__('Limit the results. The maximum amount allowed is \'%s\'', 'schema-commons'), $maxLimit);
                break;
        }
        switch ($inputFieldName) {
            case 'limit':
                return $limitDesc;
            case 'offset':
                return $this->__('Offset the results by how many positions', 'schema-commons');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'limit':
                return $this->getDefaultLimit();
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    protected function getDefaultLimit() : ?int
    {
        return null;
    }
    /**
     * Validate constraints on the input field's value
     * @param mixed $inputFieldValue
     */
    protected function validateInputFieldValue(string $inputFieldName, $inputFieldValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::validateInputFieldValue($inputFieldName, $inputFieldValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($inputFieldName === 'limit' && $this->getMaxLimit() !== null) {
            $this->validateLimitInputField($this->getMaxLimit(), $inputFieldName, $inputFieldValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    protected function getMaxLimit() : ?int
    {
        return null;
    }
    /**
     * Check the limit is not above the max limit or below -1
     * @param mixed $inputFieldValue
     */
    protected function validateLimitInputField(int $maxLimit, string $inputFieldName, $inputFieldValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        // Check the value is not below what is accepted
        $minLimit = $maxLimit === -1 ? -1 : 1;
        if ($inputFieldValue < $minLimit) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E1, [$inputFieldName, $this->getMaybeNamespacedTypeName(), $minLimit]), $astNode));
            return;
        }
        // Check the value is not below the max limit
        if ($maxLimit !== -1 && $inputFieldValue > $maxLimit) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E2, [$inputFieldName, $this->getMaybeNamespacedTypeName(), $maxLimit, $inputFieldValue]), $astNode));
            return;
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'limit':
                return $this->getLimitFilterInput();
            case 'offset':
                return $this->getOffsetFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
