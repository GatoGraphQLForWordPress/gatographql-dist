<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
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
                return $this->__('You must be logged in to set tags on custom posts', 'custompost-tag-mutations');
            case self::E2:
                return $this->__('There are no tags with ID(s) \'%s\'', 'custompost-tag-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
