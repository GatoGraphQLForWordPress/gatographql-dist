<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

use DateTime;
use DateTimeInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\AbstractScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoPSchema\SchemaCommons\FeedbackItemProviders\InputValueCoercionErrorFeedbackItemProvider;
use stdClass;
/**
 * GraphQL Custom Scalar
 *
 * @see https://spec.graphql.org/draft/#sec-Scalars.Custom-Scalars
 * @internal
 */
abstract class AbstractDateTimeScalarTypeResolver extends AbstractScalarTypeResolver
{
    public function getTypeDescription() : ?string
    {
        return \sprintf($this->__('%s scalar. It follows the ISO 8601 specification, with format "%s")', 'schema-commons'), $this->getTypeName(), $this->getDateTimeFormat());
    }
    /**
     * @param string|int|float|bool|\stdClass $inputValue
     * @return string|int|float|bool|object|null
     */
    public function coerceValue($inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsString($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        /** @var string $inputValue */
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return null;
        }
        /**
         * Validate the input has any of the supported formats
         *
         * @see https://stackoverflow.com/a/13194398
         */
        foreach ($this->getDateTimeInputFormats() as $format) {
            $dt = DateTime::createFromFormat($format, $inputValue);
            if ($dt === \false) {
                continue;
            }
            $lastErrors = $dt::getLastErrors();
            if ($lastErrors !== \false && \array_sum($lastErrors)) {
                continue;
            }
            return $dt;
        }
        $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(InputValueCoercionErrorFeedbackItemProvider::class, InputValueCoercionErrorFeedbackItemProvider::E1, [$this->getMaybeNamespacedTypeName(), $this->getDateTimeFormat()]), $astNode));
        return null;
    }
    protected abstract function getDateTimeFormat() : string;
    /**
     * Allow to define more than one input format, so that
     * Date can be represented as either:
     *
     *   - 'Y-m-d'
     *   - 'Y-m-d\TH:i:sP'
     *
     * This is needed for the DateTimeObjectSerializer,
     * which is unable to tell if the input is Date or DateTime,
     * so using the 'Y-m-d\TH:i:sP' format can support both cases.
     *
     * @return string[]
     */
    protected function getDateTimeInputFormats() : array
    {
        return [$this->getDateTimeFormat()];
    }
    /**
     * Because DateTimeObjectSerializer also uses the same format 'Y-m-d\TH:i:sP',
     * override this function to provide the specific format for each case
     *
     * @return string|int|float|bool|mixed[]|stdClass
     * @param string|int|float|bool|object $scalarValue
     */
    public function serialize($scalarValue)
    {
        /** @var DateTimeInterface $scalarValue */
        return $scalarValue->format($this->getDateTimeFormat());
    }
    /**
     * Check if the input value is already coerced.
     *
     * @param object $inputValue the object value, of any type other than stdClass
     */
    public function isAlreadyCoercedValue(object $inputValue) : bool
    {
        return $inputValue instanceof DateTimeInterface;
    }
}
