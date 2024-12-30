<?php

declare (strict_types=1);
namespace PoPCMSSchema\Meta\TypeAPIs;

use PoP\Root\Services\AbstractBasicService;
use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface;
/** @internal */
abstract class AbstractMetaTypeAPI extends AbstractBasicService implements \PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface
{
    /**
     * @var \PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface|null
     */
    private $allowOrDenySettingsService;
    protected final function getAllowOrDenySettingsService() : AllowOrDenySettingsServiceInterface
    {
        if ($this->allowOrDenySettingsService === null) {
            /** @var AllowOrDenySettingsServiceInterface */
            $allowOrDenySettingsService = $this->instanceManager->getInstance(AllowOrDenySettingsServiceInterface::class);
            $this->allowOrDenySettingsService = $allowOrDenySettingsService;
        }
        return $this->allowOrDenySettingsService;
    }
    public final function validateIsMetaKeyAllowed(string $key) : bool
    {
        return $this->getAllowOrDenySettingsService()->isEntryAllowed($key, $this->getAllowOrDenyMetaEntries(), $this->getAllowOrDenyMetaBehavior());
    }
    /**
     * If the allow/denylist validation fails, throw an exception.
     *
     * @throws MetaKeyNotAllowedException
     */
    protected final function assertIsMetaKeyAllowed(string $key) : void
    {
        if (!$this->validateIsMetaKeyAllowed($key)) {
            throw new MetaKeyNotAllowedException(\sprintf($this->__('There is no meta with key \'%s\'', 'commentmeta'), $key));
        }
    }
}
