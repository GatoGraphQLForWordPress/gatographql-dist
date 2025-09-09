<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

use PoP\GraphQLParser\Spec\Parser\Location;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/**
 * Error that concern the GraphQL document. The `$location` is where the error happens.
 * @internal
 */
abstract class AbstractDocumentFeedback extends \PoP\ComponentModel\Feedback\AbstractFeedback implements \PoP\ComponentModel\Feedback\DocumentFeedbackInterface
{
    /**
     * @param array<string,mixed> $extensions
     */
    public function __construct(
        FeedbackItemResolution $feedbackItemResolution,
        protected Location $location,
        /** @var array<string,mixed> */
        array $extensions = []
    )
    {
        parent::__construct($feedbackItemResolution, $extensions);
    }
    public function getLocation() : Location
    {
        return $this->location;
    }
}
