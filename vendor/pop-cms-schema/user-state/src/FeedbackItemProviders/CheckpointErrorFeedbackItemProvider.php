<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\Root\Feedback\FeedbackCategories;
/** @internal */
class CheckpointErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = '1';
    public const E2 = '2';
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
                return $this->__('The user is not logged-in', 'user-state');
            case self::E2:
                return $this->__('The user is logged-in', 'user-state');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
