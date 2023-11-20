<?php

declare (strict_types=1);
namespace PoPAPI\API\PersistedQueries;

/** @internal */
interface PersistedFragmentManagerInterface
{
    /**
     * @return array<string,string>
     */
    public function getPersistedFragments() : array;
    /**
     * @return array<string,array<string,string>>
     */
    public function getPersistedFragmentsForSchema() : array;
    public function addPersistedFragment(string $fragmentName, string $fragmentResolution, ?string $description = null) : void;
}
