<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\LooseContracts;

use PoP\LooseContracts\AbstractLooseContractSet;
/** @internal */
class LooseContractSet extends AbstractLooseContractSet
{
    /**
     * @return string[]
     */
    public function getRequiredNames() : array
    {
        return [
            // Options
            'popcms:option:dateFormat',
        ];
    }
}
