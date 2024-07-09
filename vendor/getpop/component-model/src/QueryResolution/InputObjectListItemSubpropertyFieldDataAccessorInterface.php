<?php

declare (strict_types=1);
namespace PoP\ComponentModel\QueryResolution;

/** @internal */
interface InputObjectListItemSubpropertyFieldDataAccessorInterface extends \PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface
{
    public function getInputObjectListSubpropertyName() : string;
    public function getInputObjectListItemPosition() : int;
}
