<?php

declare (strict_types=1);
namespace PoPAPI\API\PersistedQueries;

use PoPAPI\API\Schema\SchemaDefinition;
/** @internal */
class PersistedFragmentManager implements \PoPAPI\API\PersistedQueries\PersistedFragmentManagerInterface
{
    /**
     * @var array<string,string>
     */
    protected $persistedFragments = [];
    /**
     * @var array<string,array<string,string>>
     */
    protected $persistedFragmentsForSchema = [];
    /**
     * @return array<string,string>
     */
    public function getPersistedFragments() : array
    {
        return $this->persistedFragments;
    }
    /**
     * @return array<string,array<string,string>>
     */
    public function getPersistedFragmentsForSchema() : array
    {
        return $this->persistedFragmentsForSchema;
    }
    public function addPersistedFragment(string $fragmentName, string $fragmentResolution, ?string $description = null) : void
    {
        $this->persistedFragments[$fragmentName] = $fragmentResolution;
        $this->persistedFragmentsForSchema[$fragmentName] = [SchemaDefinition::NAME => $fragmentName];
        if ($description) {
            $this->persistedFragmentsForSchema[$fragmentName][SchemaDefinition::DESCRIPTION] = $description;
        }
    }
}
