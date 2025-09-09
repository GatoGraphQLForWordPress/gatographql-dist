<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMeta\TypeAPIs;

use PoP\Root\App;
use PoPCMSSchema\CommentMeta\Module;
use PoPCMSSchema\CommentMeta\ModuleConfiguration;
use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPCMSSchema\Meta\TypeAPIs\AbstractMetaTypeAPI;
/** @internal */
abstract class AbstractCommentMetaTypeAPI extends AbstractMetaTypeAPI implements \PoPCMSSchema\CommentMeta\TypeAPIs\CommentMetaTypeAPIInterface
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
    public final function getCommentMeta(string|int|object $commentObjectOrID, string $key, bool $single = \false, array $options = []) : mixed
    {
        if ($options['assert-is-meta-key-allowed'] ?? null) {
            $this->assertIsMetaKeyAllowed($key);
        }
        return $this->doGetCommentMeta($commentObjectOrID, $key, $single);
    }
    /**
     * @return string[]
     */
    public function getAllowOrDenyMetaEntries() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getCommentMetaEntries();
    }
    public function getAllowOrDenyMetaBehavior() : string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->getCommentMetaBehavior();
    }
    /**
     * If the key is non-existent, return `null`.
     * Otherwise, return the value.
     */
    protected abstract function doGetCommentMeta(string|int|object $commentObjectOrID, string $key, bool $single = \false) : mixed;
}
