<?php

declare (strict_types=1);
namespace PoP\Root\Services;

use PoP\Root\Services\WithInstanceManagerServiceTrait;
use PoP\Root\Translation\TranslationAPIInterface;
/** @internal */
trait BasicServiceTrait
{
    use WithInstanceManagerServiceTrait;
    /**
     * @var \PoP\Root\Translation\TranslationAPIInterface|null
     */
    private $translationAPI;
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
