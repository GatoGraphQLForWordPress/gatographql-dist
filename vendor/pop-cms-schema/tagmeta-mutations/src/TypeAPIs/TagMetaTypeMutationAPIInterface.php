<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeAPIs;

use PoPCMSSchema\TagMetaMutations\Exception\TagTermMetaCRUDMutationException;
use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface TagMetaTypeMutationAPIInterface extends TaxonomyMetaTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws TagTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     */
    public function setTagTermMeta($taxonomyTermID, array $entries) : void;
    /**
     * @return int The term_id of the newly created term
     * @throws TagTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function addTagTermMeta($taxonomyTermID, string $key, $value, bool $single = \false) : int;
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws TagTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function updateTagTermMeta($taxonomyTermID, string $key, $value);
    /**
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function deleteTagTermMeta($taxonomyTermID, string $key, $value = null) : void;
}
