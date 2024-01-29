<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers\InterfaceType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
interface InterfaceTypeFieldSchemaDefinitionResolverInterface
{
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array;
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface;
    public function getFieldDescription(string $fieldName) : ?string;
    public function getFieldTypeModifiers(string $fieldName) : int;
    public function getFieldDeprecationMessage(string $fieldName) : ?string;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(string $fieldName) : array;
    /**
     * @return string[]
     */
    public function getSensitiveFieldArgNames(string $fieldName) : array;
    public function getFieldArgDescription(string $fieldName, string $fieldArgName) : ?string;
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(string $fieldName, string $fieldArgName);
    public function getFieldArgTypeModifiers(string $fieldName, string $fieldArgName) : int;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getConsolidatedFieldArgNameTypeResolvers(string $fieldName) : array;
    /**
     * @return string[]
     */
    public function getConsolidatedSensitiveFieldArgNames(string $fieldName) : array;
    public function getConsolidatedFieldArgDescription(string $fieldName, string $fieldArgName) : ?string;
    /**
     * @return mixed
     */
    public function getConsolidatedFieldArgDefaultValue(string $fieldName, string $fieldArgName);
    public function getConsolidatedFieldArgTypeModifiers(string $fieldName, string $fieldArgName) : int;
    /**
     * @param \PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface|string $fieldOrFieldName
     */
    public function isFieldGlobal($fieldOrFieldName) : bool;
    /**
     * @param \PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface|string $fieldOrFieldName
     */
    public function isFieldAMutation($fieldOrFieldName) : bool;
    /**
     * Validate the constraints for a field argument
     * @param array<string,mixed> $fieldArgs
     * @param mixed $fieldArgValue
     */
    public function validateFieldArgValue(string $fieldName, string $fieldArgName, $fieldArgValue, AstInterface $astNode, array $fieldArgs, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
}
