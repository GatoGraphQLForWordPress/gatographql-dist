<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Schema;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\DeprecatableInputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
/** @internal */
interface InputCoercingServiceInterface
{
    /**
     * Support passing a single value where a list is expected:
     * `{ posts(ids: 1) }` means `{ posts(ids: [1]) }`
     *
     * Defined in the GraphQL spec.
     *
     * @see https://spec.graphql.org/draft/#sec-List.Input-Coercion
     * @param mixed $inputValue
     * @return mixed
     */
    public function maybeConvertInputValueFromSingleToList($inputValue, bool $inputIsNonNullable, bool $inputIsArrayType, bool $inputIsArrayOfArraysType);
    /**
     * Validate that the expected array/non-array input is provided,
     * checking that the WrappingType is respected.
     *
     * Nullable booleans can be `null` for the DangerouslyNonSpecificScalar,
     * so they can also validate their cardinality:
     *
     *   - DangerouslyNonSpecificScalar does not need to validate anything => all null
     *   - [DangerouslyNonSpecificScalar] must certainly be an array, but it doesn't care
     *     inside if it's an array or not => $inputIsArrayType => true, $inputIsArrayOfArraysType => null
     *   - [[DangerouslyNonSpecificScalar]] must be array of arrays => $inputIsArrayType => true, $inputIsArrayOfArraysType => true
     *
     * Eg: `["hello"]` must be `[String]`, can't be `[[String]]` or `String`.
     * @param mixed $inputValue
     */
    public function validateInputArrayModifiers(InputTypeResolverInterface $inputTypeResolver, $inputValue, string $inputName, ?bool $inputIsNonNullable, ?bool $inputIsArrayType, ?bool $inputIsNonNullArrayItemsType, ?bool $inputIsArrayOfArraysType, ?bool $inputIsNonNullArrayOfArraysItemsType, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
    /**
     * Coerce the input value, corresponding to the array type
     * defined by the modifiers.
     * @param mixed $inputValue
     * @return mixed
     */
    public function coerceInputValue(InputTypeResolverInterface $inputTypeResolver, $inputValue, string $inputName, bool $inputIsNonNullable, bool $inputIsArrayType, bool $inputIsArrayOfArraysType, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore);
    /**
     * If applicable, get the deprecation messages for the input value
     *
     * @return string[]
     * @param mixed $inputValue
     */
    public function getInputValueDeprecationMessages(DeprecatableInputTypeResolverInterface $inputTypeResolver, $inputValue, bool $inputIsArrayType, bool $inputIsArrayOfArraysType) : array;
}
