<?php

declare (strict_types=1);
namespace PoPAPI\API\ComponentProcessors;

/** @internal */
class RelationalFieldQueryDataComponentProcessor extends \PoPAPI\API\ComponentProcessors\AbstractRelationalFieldQueryDataComponentProcessor
{
    public const COMPONENT_LAYOUT_RELATIONALFIELDS = 'layout-relationalfields';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_LAYOUT_RELATIONALFIELDS);
    }
}
