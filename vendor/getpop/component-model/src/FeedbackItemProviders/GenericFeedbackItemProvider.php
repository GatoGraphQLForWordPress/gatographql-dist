<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FeedbackItemProviders;

use PoP\ComponentModel\Feedback\FeedbackCategories;
use PoP\Root\FeedbackItemProviders\GenericFeedbackItemProvider as UpstreamGenericFeedbackItemProvider;
/** @internal */
class GenericFeedbackItemProvider extends UpstreamGenericFeedbackItemProvider
{
    public const W1 = 'w1';
    public const N1 = 'n1';
    public const S1 = 's1';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::W1, self::N1, self::S1];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::W1:
            case self::N1:
            case self::S1:
                return '%s';
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        switch ($code) {
            case self::W1:
                return FeedbackCategories::WARNING;
            case self::N1:
                return FeedbackCategories::NOTICE;
            case self::S1:
                return FeedbackCategories::SUGGESTION;
            default:
                return parent::getCategory($code);
        }
    }
}
