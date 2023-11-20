<?php

declare (strict_types=1);
namespace PoP\ComponentModel\AttachableExtensions;

use PoP\Root\Services\ServiceInterface;
/** @internal */
class AttachExtensionService implements \PoP\ComponentModel\AttachableExtensions\AttachExtensionServiceInterface
{
    /**
     * @var array<string,array<string,AttachableExtensionInterface[]>>
     */
    protected $classGroups = [];
    public function enqueueExtension(string $event, string $group, \PoP\ComponentModel\AttachableExtensions\AttachableExtensionInterface $extension) : void
    {
        $this->classGroups[$event][$group][] = $extension;
    }
    public function attachExtensions(string $event) : void
    {
        foreach ($this->classGroups[$event] ?? [] as $group => $extensions) {
            // Only attach the enabled thervices
            $extensions = \array_filter($extensions, function (ServiceInterface $extension) {
                return $extension->isServiceEnabled();
            });
            foreach ($extensions as $extension) {
                $extension->attach($group);
            }
        }
    }
}
