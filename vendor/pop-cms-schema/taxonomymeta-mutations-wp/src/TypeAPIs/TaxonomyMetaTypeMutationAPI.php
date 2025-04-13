<?php

declare(strict_types=1);

namespace PoPCMSSchema\TaxonomyMetaMutationsWP\TypeAPIs;

use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\AbstractTaxonomyMetaTypeMutationAPI;
use WP_Error;

use function add_term_meta;
use function delete_term_meta;
use function update_term_meta;

class TaxonomyMetaTypeMutationAPI extends AbstractTaxonomyMetaTypeMutationAPI
{
    /**
     * @param string|int $entityID
     * @return int|false|\WP_Error
     * @param mixed $value
     */
    protected function executeAddEntityMeta($entityID, string $key, $value, bool $single = false)
    {
        return add_term_meta((int) $entityID, $key, $value, $single);
    }

    /**
     * @param string|int $entityID
     * @return int|bool|\WP_Error
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($entityID, string $key, $value, $prevValue = null)
    {
        return update_term_meta((int) $entityID, $key, $value, $prevValue ?? '');
    }

    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($entityID, string $key, $value = null): bool
    {
        return delete_term_meta((int) $entityID, $key, $value ?? '');
    }
}
