<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\Checkpoints;

use PoP\ComponentModel\Checkpoints\AbstractAggregateCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\Engine\Checkpoints\DoingPostCheckpoint;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
/** @internal */
class DoingPostUserLoggedInAggregateCheckpoint extends AbstractAggregateCheckpoint
{
    private ?UserLoggedInCheckpoint $userLoggedInCheckpoint = null;
    private ?DoingPostCheckpoint $doingPostCheckpoint = null;
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    protected final function getDoingPostCheckpoint() : DoingPostCheckpoint
    {
        if ($this->doingPostCheckpoint === null) {
            /** @var DoingPostCheckpoint */
            $doingPostCheckpoint = $this->instanceManager->getInstance(DoingPostCheckpoint::class);
            $this->doingPostCheckpoint = $doingPostCheckpoint;
        }
        return $this->doingPostCheckpoint;
    }
    /**
     * @return CheckpointInterface[]
     */
    protected function getCheckpoints() : array
    {
        return [$this->getDoingPostCheckpoint(), $this->getUserLoggedInCheckpoint()];
    }
}
