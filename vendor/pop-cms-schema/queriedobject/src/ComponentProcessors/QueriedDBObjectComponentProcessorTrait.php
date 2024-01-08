<?php

declare (strict_types=1);
namespace PoPCMSSchema\QueriedObject\ComponentProcessors;

use PoP\Root\App;
/** @internal */
trait QueriedDBObjectComponentProcessorTrait
{
    /**
     * @return string|int|null
     */
    protected function getQueriedDBObjectID()
    {
        return App::getState(['routing', 'queried-object-id']) ?? null;
    }
}
