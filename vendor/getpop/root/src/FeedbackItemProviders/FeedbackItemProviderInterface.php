<?php

declare (strict_types=1);
namespace PoP\Root\FeedbackItemProviders;

interface FeedbackItemProviderInterface
{
    /**
     * @return string[]
     */
    public function getCodes() : array;
    public function getNamespacedCode(string $code) : string;
    public function getMessagePlaceholder(string $code) : string;
    /**
     * @param string|int|float|bool|null ...$args
     */
    public function getMessage(string $code, ...$args) : string;
    public function getCategory(string $code) : string;
    public function getSpecifiedByURL(string $code) : ?string;
}
