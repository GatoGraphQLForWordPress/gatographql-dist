<?php

declare (strict_types=1);
namespace PoPCMSSchema\Meta\TypeAPIs;

use PoP\Root\Services\BasicServiceTrait;
use PoPCMSSchema\Meta\Exception\MetaKeyNotAllowedException;
use PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface;
abstract class AbstractMetaTypeAPI implements \PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface|null
     */
    private $allowOrDenySettingsService;
    public final function setAllowOrDenySettingsService(AllowOrDenySettingsServiceInterface $allowOrDenySettingsService) : void
    {
        $this->allowOrDenySettingsService = $allowOrDenySettingsService;
    }
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
