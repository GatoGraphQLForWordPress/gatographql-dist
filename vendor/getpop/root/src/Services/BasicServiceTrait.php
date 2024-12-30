<?php

declare (strict_types=1);
namespace PoP\Root\Services;

use PoP\Root\Instances\InstanceManagerInterface;
use PoP\Root\Translation\TranslationAPIInterface;
/** @internal */
trait BasicServiceTrait
{
    /**
     * @var \PoP\Root\Instances\InstanceManagerInterface
     */
    protected $instanceManager;
    /**
     * @var \PoP\Root\Translation\TranslationAPIInterface|null
     */
    private $translationAPI;
    /**
     * Injecting the InstanceManager service is mandatory, always.
     * It was originally done like this:
     *
     *   #[Required]
     *
     * which was downgraded to:
     *
     *   @required
     *
     * However it doesn't always work! So instead inject
     * the InstanceManager via a CompilerPass
     *
     * @see https://github.com/GatoGraphQL/GatoGraphQL/pull/3009
     */
    public final function setInstanceManager(InstanceManagerInterface $instanceManager) : void
    {
        $this->instanceManager = $instanceManager;
    }
    protected final function getInstanceManager() : InstanceManagerInterface
    {
        return $this->instanceManager;
    }
    protected final function getTranslationAPI() : TranslationAPIInterface
    {
        if ($this->translationAPI === null) {
            /** @var TranslationAPIInterface */
            $translationAPI = $this->instanceManager->getInstance(TranslationAPIInterface::class);
            $this->translationAPI = $translationAPI;
        }
        return $this->translationAPI;
    }
    /**
     * Shortcut function
     */
    protected final function __(string $text, string $domain = 'default') : string
    {
        return $this->getTranslationAPI()->__($text, $domain);
    }
}
