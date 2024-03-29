<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers\ObjectType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
/** @internal */
interface ObjectTypeFieldSchemaDefinitionResolverInterface
{
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array;
    /**
     * @return string[]
     */
    public function getSensitiveFieldNames() : array;
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface;
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string;
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int;
    public function getFieldDeprecationMessage(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string;
    /**
     * Define Schema Field Arguments
     *
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array;
    /**
     * @return string[]
     */
    public function getSensitiveFieldArgNames(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array;
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string;
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName);
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int;
    /**
     * Invoke Schema Field Arguments
     *
     * @return array<string,InputTypeResolverInterface>
     */
    public function getConsolidatedFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array;
    /**
     * @return string[]
     */
    public function getConsolidatedSensitiveFieldArgNames(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array;
    public function getConsolidatedFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string;
    /**
     * @return mixed
     */
    public function getConsolidatedFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName);
    public function getConsolidatedFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int;
    /**
     * Validate the constraints for a field argument
     * @param array<string,mixed> $fieldArgs
     * @param mixed $fieldArgValue
     */
    public function validateFieldArgValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName, $fieldArgValue, AstInterface $astNode, array $fieldArgs, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
}
