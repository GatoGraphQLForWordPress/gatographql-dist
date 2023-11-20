<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class SchemaFeedbackStore
{
    /** @var SchemaFeedbackInterface[] */
    private $errors = [];
    /** @var SchemaFeedbackInterface[] */
    private $warnings = [];
    /** @var SchemaFeedbackInterface[] */
    private $deprecations = [];
    /** @var SchemaFeedbackInterface[] */
    private $notices = [];
    /** @var SchemaFeedbackInterface[] */
    private $suggestions = [];
    /** @var SchemaFeedbackInterface[] */
    private $logs = [];
    public function incorporate(\PoP\ComponentModel\Feedback\SchemaFeedbackStore $schemaFeedbackStore) : void
    {
        $this->errors = \array_merge($this->errors, $schemaFeedbackStore->getErrors());
        $this->warnings = \array_merge($this->warnings, $schemaFeedbackStore->getWarnings());
        $this->deprecations = \array_merge($this->deprecations, $schemaFeedbackStore->getDeprecations());
        $this->notices = \array_merge($this->notices, $schemaFeedbackStore->getNotices());
        $this->suggestions = \array_merge($this->suggestions, $schemaFeedbackStore->getSuggestions());
        $this->logs = \array_merge($this->logs, $schemaFeedbackStore->getLogs());
    }
    /**
     * @param FieldInterface[] $fields
     */
    public function incorporateFromObjectTypeFieldResolutionFeedbackStore(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore, RelationalTypeResolverInterface $relationalTypeResolver, array $fields) : void
    {
        foreach ($objectTypeFieldResolutionFeedbackStore->getErrors() as $objectTypeFieldResolutionFeedbackError) {
            $this->errors[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackError, $relationalTypeResolver, $fields);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getWarnings() as $objectTypeFieldResolutionFeedbackWarning) {
            $this->warnings[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackWarning, $relationalTypeResolver, $fields);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getDeprecations() as $objectTypeFieldResolutionFeedbackDeprecation) {
            $this->deprecations[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackDeprecation, $relationalTypeResolver, $fields);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getNotices() as $objectTypeFieldResolutionFeedbackNotice) {
            $this->notices[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackNotice, $relationalTypeResolver, $fields);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getSuggestions() as $objectTypeFieldResolutionFeedbackSuggestion) {
            $this->suggestions[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackSuggestion, $relationalTypeResolver, $fields);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getLogs() as $objectTypeFieldResolutionFeedbackLog) {
            $this->logs[] = \PoP\ComponentModel\Feedback\SchemaFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackLog, $relationalTypeResolver, $fields);
        }
    }
    public function getErrorCount() : int
    {
        return \count($this->getErrors());
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    public function addError(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $error) : void
    {
        $this->errors[] = $error;
    }
    /**
     * @param SchemaFeedbackInterface[] $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getWarnings() : array
    {
        return $this->warnings;
    }
    public function addWarning(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $warning) : void
    {
        $this->warnings[] = $warning;
    }
    /**
     * @param SchemaFeedbackInterface[] $warnings
     */
    public function setWarnings(array $warnings) : void
    {
        $this->warnings = $warnings;
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getDeprecations() : array
    {
        return $this->deprecations;
    }
    public function addDeprecation(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $deprecation) : void
    {
        $this->deprecations[] = $deprecation;
    }
    /**
     * @param SchemaFeedbackInterface[] $deprecations
     */
    public function setDeprecations(array $deprecations) : void
    {
        $this->deprecations = $deprecations;
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getNotices() : array
    {
        return $this->notices;
    }
    public function addNotice(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $notice) : void
    {
        $this->notices[] = $notice;
    }
    /**
     * @param SchemaFeedbackInterface[] $notices
     */
    public function setNotices(array $notices) : void
    {
        $this->notices = $notices;
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getSuggestions() : array
    {
        return $this->suggestions;
    }
    public function addSuggestion(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $suggestion) : void
    {
        $this->suggestions[] = $suggestion;
    }
    /**
     * @param SchemaFeedbackInterface[] $suggestions
     */
    public function setSuggestions(array $suggestions) : void
    {
        $this->suggestions = $suggestions;
    }
    /**
     * @return SchemaFeedbackInterface[]
     */
    public function getLogs() : array
    {
        return $this->logs;
    }
    public function addLog(\PoP\ComponentModel\Feedback\SchemaFeedbackInterface $log) : void
    {
        $this->logs[] = $log;
    }
    /**
     * @param SchemaFeedbackInterface[] $logs
     */
    public function setLogs(array $logs) : void
    {
        $this->logs = $logs;
    }
}
