<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Feedback;

use PoP\GraphQLParser\Spec\Parser\Location;
/** @internal */
interface DocumentFeedbackInterface extends \PoP\ComponentModel\Feedback\FeedbackInterface
{
    public function getLocation() : Location;
}
