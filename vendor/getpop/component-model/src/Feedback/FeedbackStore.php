<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

/** @internal */
class FeedbackStore
{
    public \PoP\ComponentModel\Feedback\GeneralFeedbackStore $generalFeedbackStore;
    public \PoP\ComponentModel\Feedback\DocumentFeedbackStore $documentFeedbackStore;
    public function __construct()
    {
        $this->generateGeneralFeedbackStore();
        $this->generateDocumentFeedbackStore();
    }
    public function generateGeneralFeedbackStore() : void
    {
        $this->generalFeedbackStore = new \PoP\ComponentModel\Feedback\GeneralFeedbackStore();
    }
    public function generateDocumentFeedbackStore() : void
    {
        $this->documentFeedbackStore = new \PoP\ComponentModel\Feedback\DocumentFeedbackStore();
    }
}
