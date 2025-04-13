<?php

declare (strict_types=1);
namespace PoPCMSSchema\Meta\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class FeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('There is no key with name \'%s\'', 'meta');
            case self::E2:
                return $this->__('There are no keys with names \'%s\'', 'meta');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        switch ($code) {
            case self::E1:
            case self::E2:
                return FeedbackCategories::ERROR;
            default:
                return parent::getCategory($code);
        }
    }
}
