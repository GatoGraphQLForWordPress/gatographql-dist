<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMeta\TypeAPIs;

use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
/** @internal */
interface UserMetaTypeAPIInterface extends MetaTypeAPIInterface
{
    /**
     * If the allow/denylist validation fails, and passing option "assert-is-meta-key-allowed",
     * then throw an exception.
     * If the key is allowed but non-existent, return `null`.
     * Otherwise, return the value.
     *
     * @param array<string,mixed> $options
     * @throws MetaKeyNotAllowedException
     * @param string|int|object $userObjectOrID
     * @return mixed
     */
    public function getUserMeta($userObjectOrID, string $key, bool $single = \false, array $options = []);
    /**
     * @return array<string,mixed>
     * @param string|int|object $userObjectOrID
     */
    public function getAllUserMeta($userObjectOrID) : array;
    /**
     * @return string[]
     * @param string|int|object $userObjectOrID
     */
    public function getUserMetaKeys($userObjectOrID) : array;
}
