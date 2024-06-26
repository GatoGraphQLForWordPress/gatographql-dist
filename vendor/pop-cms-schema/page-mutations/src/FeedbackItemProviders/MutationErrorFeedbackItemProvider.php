<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E2 = 'e2';
    public const E3 = 'e3';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E2, self::E3];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E2:
                return $this->__('Your user doesn\'t have permission for editing pages.', 'page-mutations');
            case self::E3:
                return $this->__('Your user doesn\'t have permission for publishing pages.', 'page-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
