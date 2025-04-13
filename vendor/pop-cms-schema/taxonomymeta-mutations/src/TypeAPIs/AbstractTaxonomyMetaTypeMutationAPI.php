<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs;

use PoPCMSSchema\MetaMutations\Exception\EntityMetaCRUDMutationException;
use PoPCMSSchema\MetaMutations\TypeAPIs\AbstractEntityMetaTypeMutationAPI;
use PoPCMSSchema\TaxonomyMetaMutations\Exception\TaxonomyTermMetaCRUDMutationException;
use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface;
/** @internal */
abstract class AbstractTaxonomyMetaTypeMutationAPI extends AbstractEntityMetaTypeMutationAPI implements TaxonomyMetaTypeMutationAPIInterface
{
    /**
     * @phpstan-return class-string<EntityMetaCRUDMutationException>
     */
    protected function getEntityMetaCRUDMutationExceptionClass() : string
    {
        return TaxonomyTermMetaCRUDMutationException::class;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     */
    public function setTaxonomyTermMeta($taxonomyTermID, array $entries) : void
    {
        $this->setEntityMeta($taxonomyTermID, $entries);
    }
    /**
     * @return int The term_id of the newly created term
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function addTaxonomyTermMeta($taxonomyTermID, string $key, $value, bool $single = \false) : int
    {
        return $this->addEntityMeta($taxonomyTermID, $key, $value, $single);
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateTaxonomyTermMeta($taxonomyTermID, string $key, $value, $prevValue = null)
    {
        return $this->updateEntityMeta($taxonomyTermID, $key, $value, $prevValue);
    }
    /**
     * @throws TaxonomyTermMetaCRUDMutationException If there was an error (eg: taxonomy does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function deleteTaxonomyTermMeta($taxonomyTermID, string $key, $value = null) : void
    {
        $this->deleteEntityMeta($taxonomyTermID, $key, $value);
    }
}
