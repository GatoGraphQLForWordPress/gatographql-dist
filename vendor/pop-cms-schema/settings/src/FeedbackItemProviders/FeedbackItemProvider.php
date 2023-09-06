<?php

declare (strict_types=1);
namespace PoPCMSSchema\Settings\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
class FeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('There is no option with name \'%s\'', 'settings');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return FeedbackCategories::ERROR;
            default:
                return parent::getCategory($code);
        }
    }
}
