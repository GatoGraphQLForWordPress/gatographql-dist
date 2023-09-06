<?php

declare (strict_types=1);
namespace PoP\ComponentModel\AttachableExtensions;

interface AttachableExtensionManagerInterface
{
    /**
     * @param string $attachableClass Class or "*" to represent _any_ class
     */
    public function attachExtensionToClass(string $attachableClass, string $group, \PoP\ComponentModel\AttachableExtensions\AttachableExtensionInterface $attachableExtension) : void;
    /**
     * @return AttachableExtensionInterface[]
     */
    public function getAttachedExtensions(string $attachableClass, string $group) : array;
}
