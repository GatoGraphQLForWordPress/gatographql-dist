<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

/** @internal */
class EngineIterationFeedbackStore
{
    public \PoP\ComponentModel\Feedback\SchemaFeedbackStore $schemaFeedbackStore;
    public \PoP\ComponentModel\Feedback\ObjectResolutionFeedbackStore $objectResolutionFeedbackStore;
    public function __construct()
    {
        $this->schemaFeedbackStore = new \PoP\ComponentModel\Feedback\SchemaFeedbackStore();
        $this->objectResolutionFeedbackStore = new \PoP\ComponentModel\Feedback\ObjectResolutionFeedbackStore();
    }
    public function incorporate(\PoP\ComponentModel\Feedback\EngineIterationFeedbackStore $engineIterationFeedbackStore) : void
    {
        $this->schemaFeedbackStore->incorporate($engineIterationFeedbackStore->schemaFeedbackStore);
        $this->objectResolutionFeedbackStore->incorporate($engineIterationFeedbackStore->objectResolutionFeedbackStore);
    }
    public function hasErrors() : bool
    {
        return $this->schemaFeedbackStore->getErrors() !== [] || $this->objectResolutionFeedbackStore->getErrors() !== [];
    }
    public function getErrorCount() : int
    {
        return $this->schemaFeedbackStore->getErrorCount() + $this->objectResolutionFeedbackStore->getErrorCount();
    }
}
