<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMeta\TypeAPIs;

use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
/** @internal */
interface TaxonomyMetaTypeAPIInterface extends MetaTypeAPIInterface
{
    /**
     * If the allow/denylist validation fails, and passing option "assert-is-meta-key-allowed",
     * then throw an exception.
     * If the key is allowed but non-existent, return `null`.
     * Otherwise, return the value.
     *
     * @param array<string,mixed> $options
     * @throws MetaKeyNotAllowedException
     * @param string|int|object $termObjectOrID
     * @return mixed
     */
    public function getTaxonomyTermMeta($termObjectOrID, string $key, bool $single = \false, array $options = []);
}
