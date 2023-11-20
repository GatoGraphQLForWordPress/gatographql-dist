<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

/** @internal */
class ObjectTypeFieldResolutionFeedbackStore
{
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $errors = [];
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $warnings = [];
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $deprecations = [];
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $notices = [];
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $suggestions = [];
    /** @var ObjectTypeFieldResolutionFeedbackInterface[] */
    private $logs = [];
    public function incorporate(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->errors = \array_merge($this->errors, $objectTypeFieldResolutionFeedbackStore->getErrors());
        $this->warnings = \array_merge($this->warnings, $objectTypeFieldResolutionFeedbackStore->getWarnings());
        $this->deprecations = \array_merge($this->deprecations, $objectTypeFieldResolutionFeedbackStore->getDeprecations());
        $this->notices = \array_merge($this->notices, $objectTypeFieldResolutionFeedbackStore->getNotices());
        $this->suggestions = \array_merge($this->suggestions, $objectTypeFieldResolutionFeedbackStore->getSuggestions());
        $this->logs = \array_merge($this->logs, $objectTypeFieldResolutionFeedbackStore->getLogs());
    }
    public function getErrorCount() : int
    {
        return \count($this->getErrors());
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    public function addError(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $error) : void
    {
        $this->errors[] = $error;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getWarnings() : array
    {
        return $this->warnings;
    }
    public function addWarning(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $warning) : void
    {
        $this->warnings[] = $warning;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $warnings
     */
    public function setWarnings(array $warnings) : void
    {
        $this->warnings = $warnings;
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getDeprecations() : array
    {
        return $this->deprecations;
    }
    public function addDeprecation(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $deprecation) : void
    {
        $this->deprecations[] = $deprecation;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $deprecations
     */
    public function setDeprecations(array $deprecations) : void
    {
        $this->deprecations = $deprecations;
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getNotices() : array
    {
        return $this->notices;
    }
    public function addNotice(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $notice) : void
    {
        $this->notices[] = $notice;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $notices
     */
    public function setNotices(array $notices) : void
    {
        $this->notices = $notices;
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getSuggestions() : array
    {
        return $this->suggestions;
    }
    public function addSuggestion(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $suggestion) : void
    {
        $this->suggestions[] = $suggestion;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $suggestions
     */
    public function setSuggestions(array $suggestions) : void
    {
        $this->suggestions = $suggestions;
    }
    /**
     * @return ObjectTypeFieldResolutionFeedbackInterface[]
     */
    public function getLogs() : array
    {
        return $this->logs;
    }
    public function addLog(\PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface $log) : void
    {
        $this->logs[] = $log;
    }
    /**
     * @param ObjectTypeFieldResolutionFeedbackInterface[] $logs
     */
    public function setLogs(array $logs) : void
    {
        $this->logs = $logs;
    }
}
