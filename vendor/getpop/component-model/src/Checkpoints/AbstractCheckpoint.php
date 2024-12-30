<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Checkpoints;

use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractCheckpoint extends AbstractBasicService implements \PoP\ComponentModel\Checkpoints\CheckpointInterface
{
    /**
     * By default there's no problem
     */
    public function validateCheckpoint() : ?FeedbackItemResolution
    {
        return null;
    }
}
