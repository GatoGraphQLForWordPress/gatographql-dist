<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

/** @internal */
abstract class AbstractDataloadComponentProcessor extends \PoP\ComponentModel\ComponentProcessors\AbstractQueryDataComponentProcessor implements \PoP\ComponentModel\ComponentProcessors\DataloadingComponentInterface
{
    use \PoP\ComponentModel\ComponentProcessors\DataloadComponentProcessorTrait;
}
