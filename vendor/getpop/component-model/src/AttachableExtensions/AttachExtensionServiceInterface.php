<?php

declare (strict_types=1);
namespace PoP\ComponentModel\AttachableExtensions;

/** @internal */
interface AttachExtensionServiceInterface
{
    public function enqueueExtension(string $event, string $group, \PoP\ComponentModel\AttachableExtensions\AttachableExtensionInterface $extension) : void;
    public function attachExtensions(string $event) : void;
}
