<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

class DocumentFeedbackStore
{
    /** @var DocumentFeedbackInterface[] */
    private $errors = [];
    /** @var DocumentFeedbackInterface[] */
    private $warnings = [];
    /** @var DocumentFeedbackInterface[] */
    private $deprecations = [];
    /** @var DocumentFeedbackInterface[] */
    private $notices = [];
    /** @var DocumentFeedbackInterface[] */
    private $suggestions = [];
    /** @var DocumentFeedbackInterface[] */
    private $logs = [];
    public function getErrorCount() : int
    {
        return \count($this->getErrors());
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    public function addError(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $error) : void
    {
        $this->errors[] = $error;
    }
    /**
     * @param DocumentFeedbackInterface[] $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getWarnings() : array
    {
        return $this->warnings;
    }
    public function addWarning(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $warning) : void
    {
        $this->warnings[] = $warning;
    }
    /**
     * @param DocumentFeedbackInterface[] $warnings
     */
    public function setWarnings(array $warnings) : void
    {
        $this->warnings = $warnings;
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getDeprecations() : array
    {
        return $this->deprecations;
    }
    public function addDeprecation(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $deprecation) : void
    {
        $this->deprecations[] = $deprecation;
    }
    /**
     * @param DocumentFeedbackInterface[] $deprecations
     */
    public function setDeprecations(array $deprecations) : void
    {
        $this->deprecations = $deprecations;
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getNotices() : array
    {
        return $this->notices;
    }
    public function addNotice(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $notice) : void
    {
        $this->notices[] = $notice;
    }
    /**
     * @param DocumentFeedbackInterface[] $notices
     */
    public function setNotices(array $notices) : void
    {
        $this->notices = $notices;
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getSuggestions() : array
    {
        return $this->suggestions;
    }
    public function addSuggestion(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $suggestion) : void
    {
        $this->suggestions[] = $suggestion;
    }
    /**
     * @param DocumentFeedbackInterface[] $suggestions
     */
    public function setSuggestions(array $suggestions) : void
    {
        $this->suggestions = $suggestions;
    }
    /**
     * @return DocumentFeedbackInterface[]
     */
    public function getLogs() : array
    {
        return $this->logs;
    }
    public function addLog(\PoP\ComponentModel\Feedback\DocumentFeedbackInterface $log) : void
    {
        $this->logs[] = $log;
    }
    /**
     * @param DocumentFeedbackInterface[] $logs
     */
    public function setLogs(array $logs) : void
    {
        $this->logs = $logs;
    }
}
