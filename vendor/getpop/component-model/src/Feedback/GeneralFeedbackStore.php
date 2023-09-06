<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

class GeneralFeedbackStore
{
    /** @var GeneralFeedbackInterface[] */
    private $errors = [];
    /** @var GeneralFeedbackInterface[] */
    private $warnings = [];
    /** @var GeneralFeedbackInterface[] */
    private $deprecations = [];
    /** @var GeneralFeedbackInterface[] */
    private $notices = [];
    /** @var GeneralFeedbackInterface[] */
    private $suggestions = [];
    /** @var GeneralFeedbackInterface[] */
    private $logs = [];
    public function getErrorCount() : int
    {
        return \count($this->getErrors());
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    public function addError(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $error) : void
    {
        $this->errors[] = $error;
    }
    /**
     * @param GeneralFeedbackInterface[] $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getWarnings() : array
    {
        return $this->warnings;
    }
    public function addWarning(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $warning) : void
    {
        $this->warnings[] = $warning;
    }
    /**
     * @param GeneralFeedbackInterface[] $warnings
     */
    public function setWarnings(array $warnings) : void
    {
        $this->warnings = $warnings;
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getDeprecations() : array
    {
        return $this->deprecations;
    }
    public function addDeprecation(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $deprecation) : void
    {
        $this->deprecations[] = $deprecation;
    }
    /**
     * @param GeneralFeedbackInterface[] $deprecations
     */
    public function setDeprecations(array $deprecations) : void
    {
        $this->deprecations = $deprecations;
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getNotices() : array
    {
        return $this->notices;
    }
    public function addNotice(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $notice) : void
    {
        $this->notices[] = $notice;
    }
    /**
     * @param GeneralFeedbackInterface[] $notices
     */
    public function setNotices(array $notices) : void
    {
        $this->notices = $notices;
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getSuggestions() : array
    {
        return $this->suggestions;
    }
    public function addSuggestion(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $suggestion) : void
    {
        $this->suggestions[] = $suggestion;
    }
    /**
     * @param GeneralFeedbackInterface[] $suggestions
     */
    public function setSuggestions(array $suggestions) : void
    {
        $this->suggestions = $suggestions;
    }
    /**
     * @return GeneralFeedbackInterface[]
     */
    public function getLogs() : array
    {
        return $this->logs;
    }
    public function addLog(\PoP\ComponentModel\Feedback\GeneralFeedbackInterface $log) : void
    {
        $this->logs[] = $log;
    }
    /**
     * @param GeneralFeedbackInterface[] $logs
     */
    public function setLogs(array $logs) : void
    {
        $this->logs = $logs;
    }
}
