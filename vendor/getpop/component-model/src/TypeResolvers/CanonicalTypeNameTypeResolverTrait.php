<?php

declare (strict_types=1);
namespace PoP\ComponentModel\TypeResolvers;

/** @internal */
trait CanonicalTypeNameTypeResolverTrait
{
    /**
     * Types with reserved names can keep their name, so they don't need be namespaced
     */
    public function getNamespace() : string
    {
        return '';
    }
}
