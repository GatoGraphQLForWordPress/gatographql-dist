<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMeta\TypeAPIs;

use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
/** @internal */
interface CustomPostMetaTypeAPIInterface extends MetaTypeAPIInterface
{
    /**
     * If the allow/denylist validation fails, and passing option "assert-is-meta-key-allowed",
     * then throw an exception.
     * If the key is allowed but non-existent, return `null`.
     * Otherwise, return the value.
     *
     * @param array<string,mixed> $options
     * @throws MetaKeyNotAllowedException
     * @param string|int|object $customPostObjectOrID
     * @return mixed
     */
    public function getCustomPostMeta($customPostObjectOrID, string $key, bool $single = \false, array $options = []);
    /**
     * @return array<string,mixed>
     * @param string|int|object $customPostObjectOrID
     */
    public function getAllCustomPostMeta($customPostObjectOrID) : array;
    /**
     * @return string[]
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostMetaKeys($customPostObjectOrID) : array;
}
