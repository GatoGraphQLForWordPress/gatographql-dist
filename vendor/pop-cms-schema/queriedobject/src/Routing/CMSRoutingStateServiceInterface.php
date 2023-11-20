<?php

declare (strict_types=1);
namespace PoPCMSSchema\QueriedObject\Routing;

/** @internal */
interface CMSRoutingStateServiceInterface
{
    /**
     * Get the currently queried object
     */
    public function getQueriedObject() : ?object;
    /**
     * Get the ID of the currently queried object
     * @return string|int|null
     */
    public function getQueriedObjectID();
}
