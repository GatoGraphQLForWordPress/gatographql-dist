<?php

declare (strict_types=1);
namespace PoP\Engine\ObjectModels;

/** @internal */
class Root
{
    public final const ID = 'root';
    public function getID() : string
    {
        return self::ID;
    }
}
