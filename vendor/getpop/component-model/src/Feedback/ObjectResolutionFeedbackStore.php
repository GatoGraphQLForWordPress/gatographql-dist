<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

use PoP\ComponentModel\Engine\EngineIterationFieldSet;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
class ObjectResolutionFeedbackStore
{
    /** @var ObjectResolutionFeedbackInterface[] */
    private $errors = [];
    /** @var ObjectResolutionFeedbackInterface[] */
    private $warnings = [];
    /** @var ObjectResolutionFeedbackInterface[] */
    private $deprecations = [];
    /** @var ObjectResolutionFeedbackInterface[] */
    private $notices = [];
    /** @var ObjectResolutionFeedbackInterface[] */
    private $suggestions = [];
    /** @var ObjectResolutionFeedbackInterface[] */
    private $logs = [];
    public function incorporate(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackStore $objectResolutionFeedbackStore) : void
    {
        $this->errors = \array_merge($this->errors, $objectResolutionFeedbackStore->getErrors());
        $this->warnings = \array_merge($this->warnings, $objectResolutionFeedbackStore->getWarnings());
        $this->deprecations = \array_merge($this->deprecations, $objectResolutionFeedbackStore->getDeprecations());
        $this->notices = \array_merge($this->notices, $objectResolutionFeedbackStore->getNotices());
        $this->suggestions = \array_merge($this->suggestions, $objectResolutionFeedbackStore->getSuggestions());
        $this->logs = \array_merge($this->logs, $objectResolutionFeedbackStore->getLogs());
    }
    /**
     * @param array<string|int,EngineIterationFieldSet> $idFieldSet
     */
    public function incorporateFromObjectTypeFieldResolutionFeedbackStore(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore, RelationalTypeResolverInterface $relationalTypeResolver, Directive $directive, array $idFieldSet) : void
    {
        foreach ($objectTypeFieldResolutionFeedbackStore->getErrors() as $objectTypeFieldResolutionFeedbackError) {
            $this->errors[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackError, $relationalTypeResolver, $directive, $idFieldSet);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getWarnings() as $objectTypeFieldResolutionFeedbackWarning) {
            $this->warnings[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackWarning, $relationalTypeResolver, $directive, $idFieldSet);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getDeprecations() as $objectTypeFieldResolutionFeedbackDeprecation) {
            $this->deprecations[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackDeprecation, $relationalTypeResolver, $directive, $idFieldSet);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getNotices() as $objectTypeFieldResolutionFeedbackNotice) {
            $this->notices[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackNotice, $relationalTypeResolver, $directive, $idFieldSet);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getSuggestions() as $objectTypeFieldResolutionFeedbackSuggestion) {
            $this->suggestions[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackSuggestion, $relationalTypeResolver, $directive, $idFieldSet);
        }
        foreach ($objectTypeFieldResolutionFeedbackStore->getLogs() as $objectTypeFieldResolutionFeedbackLog) {
            $this->logs[] = \PoP\ComponentModel\Feedback\ObjectResolutionFeedback::fromObjectTypeFieldResolutionFeedback($objectTypeFieldResolutionFeedbackLog, $relationalTypeResolver, $directive, $idFieldSet);
        }
    }
    public function getErrorCount() : int
    {
        return \count($this->getErrors());
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    public function addError(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $error) : void
    {
        $this->errors[] = $error;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getWarnings() : array
    {
        return $this->warnings;
    }
    public function addWarning(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $warning) : void
    {
        $this->warnings[] = $warning;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $warnings
     */
    public function setWarnings(array $warnings) : void
    {
        $this->warnings = $warnings;
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getDeprecations() : array
    {
        return $this->deprecations;
    }
    public function addDeprecation(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $deprecation) : void
    {
        $this->deprecations[] = $deprecation;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $deprecations
     */
    public function setDeprecations(array $deprecations) : void
    {
        $this->deprecations = $deprecations;
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getNotices() : array
    {
        return $this->notices;
    }
    public function addNotice(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $notice) : void
    {
        $this->notices[] = $notice;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $notices
     */
    public function setNotices(array $notices) : void
    {
        $this->notices = $notices;
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getSuggestions() : array
    {
        return $this->suggestions;
    }
    public function addSuggestion(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $suggestion) : void
    {
        $this->suggestions[] = $suggestion;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $suggestions
     */
    public function setSuggestions(array $suggestions) : void
    {
        $this->suggestions = $suggestions;
    }
    /**
     * @return ObjectResolutionFeedbackInterface[]
     */
    public function getLogs() : array
    {
        return $this->logs;
    }
    public function addLog(\PoP\ComponentModel\Feedback\ObjectResolutionFeedbackInterface $log) : void
    {
        $this->logs[] = $log;
    }
    /**
     * @param ObjectResolutionFeedbackInterface[] $logs
     */
    public function setLogs(array $logs) : void
    {
        $this->logs = $logs;
    }
}
