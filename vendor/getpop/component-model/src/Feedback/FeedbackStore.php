<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

/** @internal */
class FeedbackStore
{
    /**
     * @var \PoP\ComponentModel\Feedback\GeneralFeedbackStore
     */
    public $generalFeedbackStore;
    /**
     * @var \PoP\ComponentModel\Feedback\DocumentFeedbackStore
     */
    public $documentFeedbackStore;
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
