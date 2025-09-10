<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMeta\TypeAPIs;

use PoP\Root\App;
use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPCMSSchema\Meta\TypeAPIs\AbstractMetaTypeAPI;
use PoPCMSSchema\UserMeta\Module;
use PoPCMSSchema\UserMeta\ModuleConfiguration;
/** @internal */
abstract class AbstractUserMetaTypeAPI extends AbstractMetaTypeAPI implements \PoPCMSSchema\UserMeta\TypeAPIs\UserMetaTypeAPIInterface
{
    /**
     * If the allow/denylist validation fails, and passing option "assert-is-meta-key-allowed",
     * then throw an exception.
     * If the key is allowed but non-existent, return `null`.
     * Otherwise, return the value.
     *
     * @param array<string,mixed> $options
     * @throws MetaKeyNotAllowedException
     */
    public final function getUserMeta(string|int|object $userObjectOrID, string $key, bool $single = \false, array $options = []) : mixed
    {
        if ($options['assert-is-meta-key-allowed'] ?? null) {
            $this->assertIsMetaKeyAllowed($key);
        }
        return $this->doGetUserMeta($userObjectOrID, $key, $single);
    }
    /**
     * @return string[]
     */
    public function getAllowOrDenyMetaEntries() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getUserMetaEntries();
    }
    public function getAllowOrDenyMetaBehavior() : string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getUserMetaBehavior();
    }
    /**
     * If the key is non-existent, return `null`.
     * Otherwise, return the value.
     */
    protected abstract function doGetUserMeta(string|int|object $userObjectOrID, string $key, bool $single = \false) : mixed;
}
