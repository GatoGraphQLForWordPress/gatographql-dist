<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers;

use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractFieldResolver extends AbstractBasicService implements \PoP\ComponentModel\FieldResolvers\FieldResolverInterface
{
    /**
     * @return string[]
     */
    public function getSensitiveFieldNames() : array
    {
        return [];
    }
}
